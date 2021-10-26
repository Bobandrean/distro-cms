<?php

namespace App\Http\Requests\Pages\Stock;

use App\Http\Requests\RequestForm;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CreateRequest extends RequestForm
{
    protected $rules;

    protected $messages;

    public function __construct(Request $request = null)
    {
        parent::__construct($request);

        $this->rules = [
            'product' => 'required',
            'stock_minimum' => 'required',
            'stock_quantity' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $stock_minimum = str_replace(',', '', $this->request->stock_minimum);
        $stock_quantity = str_replace(',', '', $this->request->stock_quantity);

        $data['id_produk'] = $this->request->product;
        $data['id_gudang'] = session()->get('department')->id;
        $data['jumlah_stok'] = $stock_quantity;
        $data['stok_minimum'] = $stock_minimum;

        return $data;
    }
}
