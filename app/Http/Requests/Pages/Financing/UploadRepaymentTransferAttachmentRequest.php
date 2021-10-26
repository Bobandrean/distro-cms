<?php

namespace App\Http\Requests\Pages\Financing;

use App\Http\Requests\RequestForm;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;


class UploadRepaymentTransferAttachmentRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'repayment_transfer_attachment' => 'required|mimes:jpg,jpeg,png,zip,pdf',
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        if ($this->request->hasFile('repayment_transfer_attachment'))
        {
            $ext_1 = $this->request->file('repayment_transfer_attachment')->getClientOriginalExtension();

            $key = 'repayment_transfer_attachment_'. str_replace(' ','_',$this->request->id).'.'.$ext_1;
            $upload = $this->uploadFile($this->request->file('repayment_transfer_attachment'), 'repayment_transfer_attachment', $key);
            $file_path = $upload['ObjectURL'];
            $data['bukti_transfer_pelunasan'] = $file_path;
        }

        return $data;
    }
}

