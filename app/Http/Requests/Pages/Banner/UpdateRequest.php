<?php

namespace App\Http\Requests\Pages\Banner;

use App\Http\Requests\RequestForm;
use App\Services\BannerService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $bannerService;

    public function __construct(Request $request = null, BannerService $bannerService)
    {
        parent::__construct($request);

        $this->bannerService = $bannerService;

        $this->rules = [
            'name' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png|max:2000'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $item = $this->bannerService->getById($this->request->id);

        if ($this->request->hasFile('file'))
        {
            $name = 'banner_'.str_replace(' ','_',$item->name).'.png';
            $this->deleteFile('banner', $name);

            $key = 'banner_'. str_replace(' ','_',$this->request->name).'.png';
            $upload = $this->uploadFile($this->request->file('file'), 'banner', $key);
            $file_path = $upload['ObjectURL'];
            $data['img_url'] = $file_path;
        }

        $data['name'] = $this->request->name;

        return $data;
    }
}
