<?php

namespace App\Http\Requests\Pages\Financing;

use App\Http\Requests\RequestForm;
use App\Services\PurchaseOrderDetailService;
use App\Services\PurchaseOrderService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;


class EditDisbursementRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $purchaseOrderService;
    private $purchaseOrderDetailService;

    public function __construct(Request $request = null, PurchaseOrderService $purchaseOrderService, PurchaseOrderDetailService $purchaseOrderDetailService)
    {
        parent::__construct($request);

        $this->purchaseOrderService = $purchaseOrderService;
        $this->purchaseOrderDetailService = $purchaseOrderDetailService;


        $this->rules = [
            'disbursement_date' => 'required',
            'interest' => 'required',
            'provisi' => 'required',
            'service_cost' => 'required',
            'disbursement_value' => 'required',
            'repayment_value' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        //Edit PO-DETAIL
        $data_po_detail['pencairan'] = 'Ya';
        $data_po_detail['tanggal_pencairan'] = Carbon::parse($this->request->disbursement_date);
        $data_po_detail['catatan'] = $this->request->notes;


        $update_po_detail = $this->purchaseOrderDetailService->updateDetail($this->request->id,$data_po_detail);

        // EDIT PO
        $data_po['biaya_bunga'] = str_replace(',', '', $this->request->interest);
        $data_po['biaya_provisi'] = str_replace(',', '', $this->request->provisi);
        $data_po['biaya_layanan'] = str_replace(',', '', $this->request->service_cost);
        $data_po['nilai_pencairan'] = str_replace(',', '', $this->request->disbursement_value);
        $data_po['nilai_pelunasan'] = str_replace(',', '', $this->request->repayment_value);
        


        $update_po = $this->purchaseOrderService->update($this->request->id, $data_po);
    }
}

