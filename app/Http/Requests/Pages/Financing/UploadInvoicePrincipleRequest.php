<?php

namespace App\Http\Requests\Pages\Financing;

use App\Http\Requests\RequestForm;
use App\Services\PurchaseOrderService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;


class UploadInvoicePrincipleRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $purchaseOrderService;

    public function __construct(Request $request = null, PurchaseOrderService $purchaseOrderService)
    {
        parent::__construct($request);

        $this->purchaseOrderService = $purchaseOrderService;

        $this->rules = [
            'file' => 'required|mimes:jpg,jpeg,png,zip,pdf'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $item = $this->purchaseOrderService->getById($this->request->id);

        if ($this->request->hasFile('file'))
        {
            $ext_1 = $this->request->file('file')->getClientOriginalExtension();

            $key = 'berkas_invoice'. str_replace(' ','_',$this->request->id).'.'.$ext_1;
            $upload = $this->uploadFile($this->request->file('file'), 'berkas_invoice', $key);
            $file_path = $upload['ObjectURL'];
            $data['berkas_invoice'] = $file_path;
        }

        $data['tanggal_invoice'] = $this->request->invoice_date;
        $data['lama_pinjaman'] = $this->request->loan;
        $data['tanggal_pencairan_pemasok'] = $this->request->disburst_date;
        $data['upload_invoice'] = 'Ya';
        $data['tanggal_upload_invoice'] = Carbon::now();
        $data['jatuh_tempo'] = Carbon::parse($this->request->disburst_date)->addDays($this->request->loan);

        return $data;
    }
}

