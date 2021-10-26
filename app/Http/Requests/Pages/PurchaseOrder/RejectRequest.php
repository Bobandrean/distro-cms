<?php

namespace App\Http\Requests\Pages\PurchaseOrder;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;

class RejectRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'description' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['keterangan'] = $this->request->description;
        $data['status_po'] = 'Dibatalkan';

        return $data;
    }
}
