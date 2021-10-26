<?php

namespace App\Http\Requests\Pages\Financing;

use App\Http\Requests\RequestForm;
use App\Services\PurchaseOrderService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use Carbon\Carbon;


class UploadInvoiceAppsRequest extends RequestForm
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

            $key = 'berkas_po_'. str_replace(' ','_',$this->request->id).'.'.$ext_1;
            $upload = $this->uploadFile($this->request->file('file'), 'berkas_po', $key);
            $file_path = $upload['ObjectURL'];
            $data['berkas_po'] = $file_path;
        }

        $data['upload_po'] = 'Ya';
        $data['tanggal_upload_po'] = Carbon::now();

        return $data;
    }
}

