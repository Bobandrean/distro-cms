<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProvinceService;

class ProvinceController extends Controller
{
    private $request;
    private $provinceService;

    public function __construct(Request $request, ProvinceService $provinceService)
    {
        $this->request = $request;
		$this->provinceService = $provinceService;
    }

    public function all()
    {
    	$items = $this->provinceService->all();

        return response()->json(['data' => $items, 'success' => true]);
    }
}
