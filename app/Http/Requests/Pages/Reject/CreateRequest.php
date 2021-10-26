<?php

namespace App\Http\Requests\Pages\Reject;

use App\Http\Requests\RequestForm;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class CreateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'buyer' => 'required',
            'payment_type' => 'required',
            'reason' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['id_pembeli'] = $this->request->buyer;
        $data['id_pembayaran'] = $this->request->payment_type;
        $data['keterangan'] = $this->request->reason;

        return $data;
    }
}
