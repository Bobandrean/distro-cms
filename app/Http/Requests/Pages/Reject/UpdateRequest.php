<?php

namespace App\Http\Requests\Pages\Reject;

use App\Http\Requests\RequestForm;
use App\Services\RejectService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $rejectService;

    public function __construct(Request $request = null, RejectService $rejectService)
    {
        parent::__construct($request);

        $this->rejectService = $rejectService;

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
