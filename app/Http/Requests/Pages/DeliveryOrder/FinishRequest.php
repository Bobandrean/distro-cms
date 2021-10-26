<?php

namespace App\Http\Requests\Pages\DeliveryOrder;

use App\Http\Requests\RequestForm;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class FinishRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'delivery_attachment' => 'required',
            'invoice_attachment' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['status_do'] = 'Selesai';

        if ($this->request->hasFile('delivery_attachment')):
            $ext1 = $this->request->file('delivery_attachment')->getClientOriginalExtension();
            $key1 = 'bukti_' . $this->request->id . '.' . $ext1;
            $upload1 = $this->uploadFile($this->request->file('delivery_attachment'), 'foto_bukti_pengiriman', $key1);
            $file_path1 = $upload1['ObjectURL'];
            $data['foto_bukti_pengiriman'] = $file_path1;
        endif;

        if ($this->request->hasFile('invoice_attachment')):
            $ext2 = $this->request->file('invoice_attachment')->getClientOriginalExtension();
            $key2 = 'invoice_' . $this->request->id . '.' . $ext2;
            $upload2 = $this->uploadFile($this->request->file('invoice_attachment'), 'foto_invoice', $key2);
            $file_path2 = $upload2['ObjectURL'];
            $data['foto_invoice'] = $file_path2;
        endif;

        return $data;
    }
}
