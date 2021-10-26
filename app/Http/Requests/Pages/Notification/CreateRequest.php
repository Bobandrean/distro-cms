<?php

namespace App\Http\Requests\Pages\Notification;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;

class CreateRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'title' => 'required|unique:global_notification,title',
            'notification' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['title'] = $this->request->title;
        $data['notification'] = $this->request->notification;
        $data['data'] = $this->request->data;

        return $data;
    }
}
