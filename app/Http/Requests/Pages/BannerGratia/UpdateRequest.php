<?php

namespace App\Http\Requests\Pages\BannerGratia;

use App\Http\Requests\RequestForm;
use App\Services\BannerGratiaService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $bannerGratiaService;

    public function __construct(Request $request = null, BannerGratiaService $bannerGratiaService)
    {
        parent::__construct($request);

        $this->bannerGratiaService = $bannerGratiaService;

        $this->rules = [
            'name' => 'required',
            'file' => 'nullable|mimes:jpg,jpeg,png|max:2000'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $item = $this->bannerGratiaService->getById($this->request->id);

        if ($this->request->hasFile('file'))
        {
            $name = 'bannergratia_'.str_replace(' ','_',$item->name).'.png';
            $this->deleteFile('bannergratia', $name);

            $key = 'bannergratia_'. str_replace(' ','_',$this->request->name).'.png';
            $upload = $this->uploadFile($this->request->file('file'), 'bannergratia', $key);
            $file_path = $upload['ObjectURL'];
            $data['img_url'] = $file_path;
        }

        $data['name'] = $this->request->name;

        return $data;
    }
}
