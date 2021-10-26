<?php

namespace App\Http\Requests\Pages\Customer;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Traits\fileUploadTrait;
use Carbon\Carbon;

class AddRelationRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'supplier' => 'required',
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();
        $data['id_pembeli'] = $this->request->id;
        $data['id_pemasok'] = $this->request->supplier;
     
        return $data;
    }
}
