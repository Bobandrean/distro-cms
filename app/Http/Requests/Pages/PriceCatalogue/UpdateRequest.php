<?php

namespace App\Http\Requests\Pages\PriceCatalogue;

use App\Http\Requests\RequestForm;
use App\Services\PriceCatalogueService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class UpdateRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    private $productService;

    private $priceCatalogueService;

    public function __construct(Request $request = null, ProductService $productService, PriceCatalogueService $priceCatalogueService)
    {
        parent::__construct($request);

        $this->productService = $productService;

        $this->priceCatalogueService = $priceCatalogueService;

        $this->rules = [
            'selling_price' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $price_catalogue = $this->priceCatalogueService->getById($this->request->id);
        $product = $this->productService->getById($price_catalogue->id_produk);
        $selling_price = str_replace(',', '', $this->request->selling_price);
        $het = str_replace(',', '', $this->request->het);
        $margin = (double)$selling_price - (double)$product->harga;

        $data['harga_jual'] = $selling_price;
        $data['het'] = $het;
        $data['laba'] = $margin;

        return $data;
    }
}
