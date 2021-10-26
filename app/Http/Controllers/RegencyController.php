<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RegencyService;

class RegencyController extends Controller
{
    private $request;
    private $regencyService;

    public function __construct(Request $request, RegencyService $regencyService)
    {
        $this->request = $request;
		$this->regencyService = $regencyService;
    }

    public function all($id)
    {
        $items = $this->regencyService->getByProvinceId($id);         

        return response()->json(['data' => $items, 'success' => true]);
    }
}
