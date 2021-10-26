<?php

namespace App\Http\Requests\Pages\Financing;

use App\Http\Requests\RequestForm;
use App\Services\PurchaseOrderDetailService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;


class EditStatusP2PRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $purchaseOrderDetailService;


    public function __construct(Request $request = null,PurchaseOrderDetailService $purchaseOrderDetailService)
    {
        parent::__construct($request);

        $this->purchaseOrderDetailService = $purchaseOrderDetailService;

        $this->rules = [
            'status_kreditpro' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['status_kreditpro'] = $this->request->status_kreditpro;
        $data['tanggal_status'] = Carbon::now();

        $update_po_detail = $this->purchaseOrderDetailService->updateDetail($this->request->id,$data);
    }
}

