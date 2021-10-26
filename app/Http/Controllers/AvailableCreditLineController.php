<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\PaymentTypeCustomerService;
use App\Services\ProvinceService;
use App\Services\RegencyService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class AvailableCreditLineController extends Controller
{
    private $paymentTypeCustomerService;
    private $request;
    private $customerService;
    private $provinceService;
    private $regencyService;

    public function __construct(
        PaymentTypeCustomerService $paymentTypeCustomerService, Request $request, CustomerService $customerService,
        ProvinceService $provinceService, RegencyService $regencyService
    )
    {
        $this->paymentTypeCustomerService = $paymentTypeCustomerService;
        $this->request = $request;
        $this->customerService = $customerService;
        $this->provinceService = $provinceService;
        $this->regencyService = $regencyService;
    }

    public function index()
    {
        $items = $this->paymentTypeCustomerService->datatableGroupByPaymentType();

        return view('contents.available-credit-line.index', compact('items'));
    }

    public function view($id)
    {
        $items = $this->paymentTypeCustomerService->getByPaymentTypeId($id, $this->request);
        $request = $this->request;
        $customers = $this->customerService->all();
        $provinces = $this->provinceService->all();
        $regencies = $this->regencyService->all();

        if ($this->request->export == '1'):
            return $this->exportByPaymentTypeId($id);
        endif;

        return view('contents.available-credit-line.view', compact('items', 'request', 'customers', 'provinces', 'regencies'));
    }

    public function exportByPaymentTypeId($id)
    {
        $rows = $this->paymentTypeCustomerService->exportByPaymentTypeId($id, $this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/available-credit-line.detail.table.col_1') => $row->pembeli->nama_usaha . '(' . $row->pembeli->nama_depan . ' ' . $row->pembeli->nama_belakang . ')',
                __('pages/available-credit-line.detail.table.col_2') => $row->pembeli->province->nama,
                __('pages/available-credit-line.detail.table.col_3') => $row->pembeli->regency->nama,
                __('pages/available-credit-line.detail.table.col_4') => $row->plafon_kredit,
                __('pages/available-credit-line.detail.table.col_5') => $row->sisa_plafon,
            ];
        endforeach;

        return FastExcel::data($data)->download('available_credit_line_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
