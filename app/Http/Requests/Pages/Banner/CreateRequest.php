<?php

namespace App\Http\Requests\Pages\Banner;

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
            'name' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png|max:2000'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        if ($this->request->hasFile('file'))
        {
            $key = 'banner_'. str_replace(' ','_',$this->request->name).'.png';
            $upload = $this->uploadFile($this->request->file('file'), 'banner', $key);
            $file_path = $upload['ObjectURL'];
            $data['img_url'] = $file_path;
        }

        $data['name'] = $this->request->name;

        return $data;
    }
}
