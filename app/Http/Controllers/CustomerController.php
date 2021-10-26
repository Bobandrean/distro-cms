<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\Pages\Customer\AddRelationRequest;
use App\Http\Requests\Pages\Customer\StorePaymentRequest;
use App\Http\Requests\Pages\Customer\UpdatePaymentRequest;
use App\Http\Requests\Pages\Customer\UpdateRequest;
use App\Http\Requests\Pages\Customer\CreateRequest;

use App\Services\CustomerService;
use App\Services\UserService;
use App\Services\CmsLogService;
use App\Services\RegencyService;
use App\Services\ProvinceService;
use App\Services\SupplierService;
use App\Services\CustomerSupplierRelationService;
use App\Services\PaymentTypeService;
use App\Services\PaymentTypeCustomerService;
use App\Services\PaymentTypeDayService;
use App\Services\PaymentTypeMethodService;

use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class CustomerController extends Controller
{
    private $request;

    private $userService;
    private $supplierService;
    private $customerService;
    private $cmsLogService;
    private $regencyService;
    private $provinceService;
    private $customerSupplierRelationService;
    private $paymentTypeService;
    private $paymentTypeCustomerService;
    private $paymentTypeDayService;
    private $paymentTypeMethodService;

    public function __construct(
        Request $request,
        UserService $userService,
        SupplierService $supplierService,
        CustomerService $customerService,
        CmsLogService $cmsLogService,
        RegencyService $regencyService,
        ProvinceService $provinceService,
        CustomerSupplierRelationService $customerSupplierRelationService,
        PaymentTypeService $paymentTypeService,
        PaymentTypeCustomerService $paymentTypeCustomerService,
        PaymentTypeDayService $paymentTypeDayService,
        PaymentTypeMethodService $paymentTypeMethodService
        )
    {
        $this->request = $request;

        $this->userService = $userService;
        $this->supplierService = $supplierService;
		$this->customerService = $customerService;
        $this->cmsLogService = $cmsLogService;
        $this->regencyService = $regencyService;
        $this->provinceService = $provinceService;
        $this->customerSupplierRelationService = $customerSupplierRelationService;
        $this->paymentTypeService = $paymentTypeService;
        $this->paymentTypeCustomerService = $paymentTypeCustomerService;
        $this->paymentTypeDayService = $paymentTypeDayService;
        $this->paymentTypeMethodService = $paymentTypeMethodService;
    }

    public function index()
    {
        $payment_id = session()->get('payment_id');

        if($payment_id == 0){
    	   $items = $this->customerService->datatable($this->request);
        }else{
           $items = $this->customerService->getByPaymentId($payment_id, $this->request);
        }

    	$request = $this->request;

        $provinces = $this->provinceService->all();
        $regencies = $this->regencyService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;
        // return $items;
        return view('contents.customer.index', compact('items','request','provinces','regencies','payment_id'));
    }

    public function relation()
    {
        $items = $this->customerService->getByIdWith($this->request->id, ['relasi_pembeli_pemasok.pemasok']);

        $supplier = $this->supplierService->all();

        $request = $this->request;

        return view('contents.customer.relations', compact('items','request','supplier'));
    }

    public function addRelation(AddRelationRequest $addRelationRequest)
    {
        $datacustomer = $this->customerSupplierRelationService->getByCustomerId($this->request->id);

        foreach($datacustomer as $dc){
            if($dc->id_pemasok == $this->request->supplier){
                return back()->with('error',__('global.exist_notification'));
            }
        }

        DB::beginTransaction();

        try {

            $data = $addRelationRequest->handle();

            $this->customerSupplierRelationService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Relasi Pembeli dengan User ID '.$this->request->id_user]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.store_success_notification'));;
    }

    public function paymentType()
    {
        $items = $this->customerService->getByIdWith($this->request->id, ['tipe_pembayaran_pembeli.tipe_pembayaran']);

        $request = $this->request;

        return view('contents.customer.payment-type', compact('items','request'));
    }

    public function addPaymentType()
    {
        $payment_type = $this->paymentTypeService->all();

        $request = $this->request;

        return view('contents.customer.add-payment-type', compact('payment_type','request'));
    }

    public function editPaymentType($customer_id, $payment_id)
    {
        $payment_type = $this->paymentTypeService->all();

        $payment_type_customer = $this->paymentTypeCustomerService->getCreditInfo($customer_id, $payment_id);
        $payment_type_day = $this->paymentTypeDayService->getByCustomerIdAndPaymentType($customer_id, $payment_id);
        $payment_type_method = $this->paymentTypeMethodService->getByCustomerIdAndPaymentType($customer_id, $payment_id);

        $request = $this->request;

        $customer_id = $customer_id;

        return view('contents.customer.edit-payment-type', compact('payment_type','request','payment_type_customer','payment_type_day','payment_type_method','customer_id'));
    }

    public function storePaymentType(StorePaymentRequest $storePaymentRequest, $id)
    {
        DB::beginTransaction();

        try {

            $storePaymentRequest->handle();
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Tipe Pembayaran untuk Pembeli dengan User ID '.$id]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return redirect()->route('customer.payment-type', $id)->with('success',__('global.store_success_notification'));
    }

    public function updatePaymentType(updatePaymentRequest $updatePaymentRequest, $customer_id, $payment_id)
    {
        DB::beginTransaction();

        try
        {
            $updatePaymentRequest->handle();
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Tipe Pembayaran '.$payment_id.' dengan ID Pembeli'.$customer_id]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return redirect()->route('customer.payment-type', $customer_id)->with('success',__('global.update_success_notification'));
    }

    public function destroyPaymentType($customer_id, $payment_id)
    {
        DB::beginTransaction();

        try
        {
            $this->paymentTypeCustomerService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);
            $this->paymentTypeDayService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);
            $this->paymentTypeMethodService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Tipe Pembayaran Pembeli dengan ID Pembeli '.$customer_id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.destroy_success_notification'));;
    }

    public function create()
    {
        return view('contents.customer.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try {

            $createRequest->handle();
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Pembeli']);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return redirect()->route('customer.index')->with('success',__('global.store_success_notification'));
    }

    public function export()
    {
        $rows = $this->customerService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/customer.table.col_1') => $row->nama_usaha,
                __('pages/customer.table.col_2') => $row->nama_depan.' '.$row->nama_belakang,
                __('pages/customer.table.col_3') => $row->province->nama,
                __('pages/customer.table.col_4') => $row->regency->nama
            ];
        endforeach;

        return FastExcel::data($data)->download('customer_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function edit($id)
    {
        $item = $this->customerService->getById($id);
        $user = $this->userService->getById($item->id_user);

        return view('contents.customer.edit',compact('item','id','user'));
    }

    public function update(UpdateRequest $updateRequest, $id)
    {
        DB::beginTransaction();

        try
        {
            $updateRequest->handle();
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Pembeli dengan User ID '.$id]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return redirect()->route('customer.index')->with('success',__('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $data['status'] = '0';

            $this->userService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Pembeli dengan User ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('customer.index')->with('success',__('global.destroy_success_notification'));
    }

    public function destroyPayment($id)
    {
        $item = $this->paymentTypeCustomerService->getById($id);

        $customer_id = $item->id_pembeli;
        $payment_id = $item->id_pembayaran;

        DB::beginTransaction();

        try
        {
            $this->paymentTypeCustomerService->destroy($id);
            $this->paymentTypeDayService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);
            $this->paymentTypeMethodService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Tipe Pembayaran Pembeli dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.destroy_success_notification'));;
    }

    public function destroyRelation($id)
    {
        DB::beginTransaction();

        try
        {
            $this->customerSupplierRelationService->destroy($id);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Relasi Pembeli dengan User ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.destroy_success_notification'));;
    }
}
