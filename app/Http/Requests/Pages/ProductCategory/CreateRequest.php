<?php

namespace App\Http\Requests\Pages\ProductCategory;

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
            'name' => 'required|unique:kategori_produk,nama',
            'icon' => 'nullable|max:2000|mimes:jpg,jpeg,png'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        if ($this->request->hasFile('icon')):
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
