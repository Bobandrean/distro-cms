<?php

namespace App\Http\Requests\Pages\BuyerType;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'name' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['nama'] = $this->request->name;
        $data['keterangan'] = $this->request->description;

        return $data;
    }
}
