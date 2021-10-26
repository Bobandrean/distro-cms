<?php

namespace App\Http\Requests\Pages\Financing;

use App\Http\Requests\RequestForm;
use App\Services\PurchaseOrderService;
use App\Services\PurchaseOrderDetailService;
use App\Services\PaymentTypeCustomerService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;


class EditRepaymentRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $purchaseOrderService;
    private $purchaseOrderDetailService;
    private $paymentTypeCustomerService;

    public function __construct(Request $request = null, PurchaseOrderService $purchaseOrderService,PurchaseOrderDetailService $purchaseOrderDetailService,PaymentTypeCustomerService $paymentTypeCustomerService)
    {
        parent::__construct($request);

        $this->purchaseOrderService = $purchaseOrderService;
        $this->purchaseOrderDetailService = $purchaseOrderDetailService;
        $this->paymentTypeCustomerService = $paymentTypeCustomerService;

        $this->rules = [
            'repayment_attachment' => 'required|mimes:jpg,jpeg,png,pdf,zip',
            'repayment_date' => 'required',
            'repayment_status' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $item = $this->purchaseOrderService->getById($this->request->id);
        $credit = $this->paymentTypeCustomerService->getCreditInfo($item->id_pembeli, $item->id_pembayaran);

        if ($this->request->hasFile('repayment_attachment'))
        {
            $ext = $this->request->file('repayment_attachment')->getClientOriginalExtension();

            $name = 'berkas_pelunasan_'.$this->request->id.'.'.$ext;
            $this->deleteFile('berkas_pelunasan',$name);

            $key = 'berkas_pelunasan_'. $this->request->id.'.'.$ext;
            $upload = $this->uploadFile($this->request->file('repayment_attachment'), 'berkas_pelunasan', $key);
            $file_path = $upload['ObjectURL'];
            $data_po_detail['berkas_pelunasan'] = $file_path;
        }

        //Edit PO-DETAIL
        $data_po_detail['status_pelunasan'] = $this->request->repayment_status;
        $data_po_detail['tanggal_pelunasan'] = Carbon::parse($this->request->repayment_date);
        $data_po_detail['catatan'] = $this->request->notes;

        $this->purchaseOrderDetailService->updateDetail($this->request->id,$data_po_detail);

        // update customer's credit balance
        if ($this->request->repayment_status == 'Lunas'):
            $credit_data['sisa_plafon'] = (double)$credit->sisa_plafon + (double)$item->subtotal;
            $this->paymentTypeCustomerService->update($credit->id, $credit_data);
        endif;
    }
}

