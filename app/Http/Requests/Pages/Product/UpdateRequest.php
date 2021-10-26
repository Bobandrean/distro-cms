<?php

namespace App\Http\Requests\Pages\Product;

use App\Http\Requests\RequestForm;
use App\Services\ProductService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $productService;

    public function __construct(Request $request = null, ProductService $productService)
    {
        parent::__construct($request);

        $this->productService = $productService;

        $this->rules = [
            'sku' => 'required',
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'measurement' => 'required',
            'packaging' => 'required',
            'base_price' => 'required',
            'price' => 'required',
            'photo1' => 'nullable|max:2000|mimes:jpg,jpeg,png',
            'photo2' => 'nullable|max:2000|mimes:jpg,jpeg,png',
            'photo3' => 'nullable|max:2000|mimes:jpg,jpeg,png'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $data['id_kategori_produk'] = $this->request->category;
        $data['id_satuan_produk'] = $this->request->measurement;
        $data['id_jenis_kemasan'] = $this->request->packaging;
        $data['kode'] = $this->request->sku;
        $data['nama'] = $this->request->name;
        $data['deskripsi'] = $this->request->description;
        $data['berat'] = str_replace(',', '', $this->request->weight);
        $data['isi_kemasan'] = str_replace(',', '', $this->request->quantity);
        $data['panjang'] = str_replace(',', '', $this->request->length);
        $data['lebar'] = str_replace(',', '', $this->request->width);
        $data['tinggi'] = str_replace(',', '', $this->request->height);
        $data['ppn'] = (isset($this->request->tax)) ? 'Ya' : 'Tidak';
        $data['harga_dasar'] = str_replace(',', '', $this->request->base_price);
        $data['harga'] = str_replace(',', '', $this->request->price);

        $item = $this->productService->getById($this->request->id);

        if ($this->request->hasFile('photo1')):
            $name1 = str_replace(' ','_',$item->kode) . '_' . str_replace(' ', '_', $item->nama) . '_1.png';
            $this->deleteFile('product', $name1);

            $key1 = str_replace(' ','_',$this->request->sku) . '_' . str_replace(' ', '_', $this->request->name) . '_1.png';
            $upload1 = $this->uploadFile($this->request->file('photo1'), 'product', $key1);
            $file_path1 = $upload1['ObjectURL'];
            $data['foto_1'] = $file_path1;
        endif;

        if ($this->request->hasFile('photo2')):
            $name2 = str_replace(' ','_',$item->kode) . '_' . str_replace(' ', '_', $item->nama) . '_2.png';
            $this->deleteFile('product', $name2);

            $key2 = str_replace(' ','_',$this->request->sku) . '_' . str_replace(' ', '_', $this->request->name) . '_2.png';
            $upload2 = $this->uploadFile($this->request->file('photo2'), 'product', $key2);
            $file_path2 = $upload2['ObjectURL'];
            $data['foto_2'] = $file_path2;
        endif;

        if ($this->request->hasFile('photo3')):
            $name3 = str_replace(' ','_',$item->kode) . '_' . str_replace(' ', '_', $item->nama) . '_3.png';
            $this->deleteFile('product', $name3);

            $key3 = str_replace(' ','_',$this->request->sku) . '_' . str_replace(' ', '_', $this->request->name) . '_3.png';
            $upload3 = $this->uploadFile($this->request->file('photo3'), 'product', $key3);
            $file_path3 = $upload3['ObjectURL'];
            $data['foto_3'] = $file_path3;
        endif;

        return $data;
    }
}
