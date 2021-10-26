<?php

namespace App\Http\Requests\Pages\PriceCatalogue;

use App\Http\Requests\RequestForm;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CreateRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    private $productService;

    public function __construct(Request $request = null, ProductService $productService)
    {
        parent::__construct($request);

        $this->productService = $productService;

        $this->rules = [
            'buyer_type' => 'required',
            'product' => 'required',
            'selling_price' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $product = $this->productService->getById($this->request->product);
        $selling_price = str_replace(',', '', $this->request->selling_price);
        $het = str_replace(',', '', $this->request->het);
        $margin = (double)$selling_price - (double)$product->harga;

        $data['id_tipe_pembeli'] = $this->request->buyer_type;
        $data['id_produk'] = $this->request->product;
        $data['id_pemasok'] = session()->get('department')->id;
        $data['id_kategori'] = $product->id_kategori_produk;
        $data['harga_beli'] = $product->harga;
        $data['harga_jual'] = $selling_price;
        $data['het'] = $het;
        $data['laba'] = $margin;

        return $data;
    }
}
