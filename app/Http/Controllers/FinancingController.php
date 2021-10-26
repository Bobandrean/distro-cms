<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\Financing\UploadDisbursementTransferAttachmentRequest;
use App\Http\Requests\Pages\Financing\UploadRepaymentTransferAttachmentRequest;
use App\Services\PaymentTypeService;
use Illuminate\Http\Request;
use App\Services\PurchaseOrderService;
use App\Services\PurchaseOrderDetailService;
use Illuminate\Support\Facades\DB;
use App\Services\CmsLogService;
use App\Http\Requests\Pages\Financing\UploadInvoiceAppsRequest;
use App\Http\Requests\Pages\Financing\UploadInvoicePrincipleRequest;
use App\Http\Requests\Pages\Financing\EditStatusP2PRequest;
use App\Http\Requests\Pages\Financing\EditDisbursementRequest;
use App\Http\Requests\Pages\Financing\EditRepaymentRequest;

class FinancingController extends Controller
{
    private $request;
    private $purchaseOrderService;
    private $cmsLogService;
    private $purchaseOrderDetailService;
    private $paymentTypeService;

    public function __construct(
        Request $request,
        PurchaseOrderService $purchaseOrderService,
        CmsLogService $cmsLogService,
        PurchaseOrderDetailService $purchaseOrderDetailService,
        PaymentTypeService $paymentTypeService
    )
    {
        $this->purchaseOrderService = $purchaseOrderService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
        $this->purchaseOrderDetailService = $purchaseOrderDetailService;
        $this->paymentTypeService = $paymentTypeService;
    }

    public function index()
    {
        $items = $this->purchaseOrderService->datatableFinancing($this->request);

        $request = $this->request;

        $payments = $this->paymentTypeService->all();

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.financing.index', compact('items', 'request', 'payments'));
    }

    public function getUploadInvApps($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id, ['pemasok', 'pembeli', 'tipe_pembayaran', 'tipe_pengiriman', 'po_billing', 'po_detail', 'po_barang.produk']);
        return view('contents.financing.edit-inv-apps', compact('item'));
    }

    public function uploadInvApps($id, UploadInvoiceAppsRequest $updateRequest)
    {
        DB::beginTransaction();

        try {
            $data = $updateRequest->handle();
            $this->purchaseOrderDetailService->updateDetail($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Berkas Invoice Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }

    public function getUploadInvPrinc($id)
    {

        $item = $this->purchaseOrderService->getByIdWith($id, ['pemasok', 'pembeli', 'tipe_pembayaran', 'tipe_pengiriman', 'po_billing', 'po_detail', 'po_barang.produk']);
        return view('contents.financing.edit-inv-princ', compact('item'));
    }

    public function uploadInvPrinc($id, UploadInvoicePrincipleRequest $updateRequest)
    {
        DB::beginTransaction();

        try {
            $data = $updateRequest->handle();
            $this->purchaseOrderDetailService->updateDetail($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Berkas Invoice Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }

    public function getEditStatusP2P($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id, ['pemasok', 'pembeli', 'tipe_pembayaran', 'tipe_pengiriman', 'po_billing', 'po_detail', 'po_barang.produk']);
        return view('contents.financing.edit-status-p2p', compact('item'));
    }

    public function EditStatusP2P($id, EditStatusP2PRequest $updateRequest)
    {
        DB::beginTransaction();
        try {
            $updateRequest->handle();
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Status P2P Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }

    public function getEditDisbursement($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id, ['pemasok', 'pembeli', 'tipe_pembayaran', 'tipe_pengiriman', 'po_billing', 'po_detail', 'po_barang.produk']);
        return view('contents.financing.edit-disbursement', compact('item'));
    }

    public function EditDisbursement($id, EditDisbursementRequest $updateRequest)
    {
        DB::beginTransaction();
        try {
            $updateRequest->handle();
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Status Pencairan Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }

    public function getEditRepayment($id)
    {
        $item = $this->purchaseOrderService->getByIdWith($id, ['pemasok', 'pembeli', 'tipe_pembayaran', 'tipe_pengiriman', 'po_billing', 'po_detail', 'po_barang.produk']);
        return view('contents.financing.edit-repayment', compact('item'));
    }

    public function EditRepayment($id, EditRepaymentRequest $updateRequest)
    {
        DB::beginTransaction();
        try {
            $updateRequest->handle();

            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengubah Status Pencairan Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }

    public function getUploadDisbursementTransferAttachment($id)
    {
        return view('contents.financing.upload-disbursement-transfer-attachment', compact('id'));
    }

    public function uploadDisbursementTransferAttachment($id, UploadDisbursementTransferAttachmentRequest $uploadRequest)
    {
        DB::beginTransaction();

        try {
            $data = $uploadRequest->handle();
            $this->purchaseOrderDetailService->updateDetail($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengupload Bukti Transfer Pencairan Dengan ID PO' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }

    public function getUploadRepaymentTransferAttachment($id)
    {
        return view('contents.financing.upload-repayment-transfer-attachment', compact('id'));
    }

    public function uploadRepaymentTransferAttachment($id, UploadRepaymentTransferAttachmentRequest $uploadRequest)
    {
        DB::beginTransaction();

        try {
            $data = $uploadRequest->handle();
            $this->purchaseOrderDetailService->updateDetail($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username . ' Mengupload Bukti Transfer Pelunasan Dengan ID PO' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('financing.index')->with('success', __('global.update_success_notification'));
    }
}
