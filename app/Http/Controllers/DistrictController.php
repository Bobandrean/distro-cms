<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DistrictService;

class DistrictController extends Controller
{
    private $request;
    private $districtService;

    public function __construct(Request $request, DistrictService $districtService)
    {
        $this->request = $request;
		$this->districtService = $districtService;
    }

    public function all($id)
    {
        $items = $this->districtService->getByDistrictId($id);         

        return response()->json(['data' => $items, 'success' => true]);
    }
}
