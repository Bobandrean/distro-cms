<?php

namespace App\Http\Requests\Pages\ProductCategory;

use App\Http\Requests\RequestForm;
use App\Services\ProductCategoryService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $productCategoryService;

    public function __construct(Request $request = null, ProductCategoryService $productCategoryService)
    {
        parent::__construct($request);

        $this->productCategoryService = $productCategoryService;

        $this->rules = [
            'name' => 'required',
            'icon' => 'nullable|max:2000|mimes:jpg,jpeg,png'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $item = $this->productCategoryService->getById($this->request->id);

        if ($this->request->hasFile('icon')):
            $name = str_replace(' ', '_', $item->nama) . '.png';
            $this->deleteFile('productcategories', $name);

            $key = str_replace(' ', '_', $this->request->name) . '.png';
            $upload = $this->uploadFile($this->request->file('icon'), 'productcategories', $key);
            $file_path = $upload['ObjectURL'];
            $data['ikon'] = $file_path;
        endif;

        $data['nama'] = $this->request->name;
        $data['deskripsi'] = $this->request->description;
        $data['hapus'] = '0';

        return $data;
    }
}
