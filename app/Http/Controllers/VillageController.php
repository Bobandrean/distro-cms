<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\VillageService;

class VillageController extends Controller
{
    private $request;
    private $villageService;

    public function __construct(Request $request, VillageService $villageService)
    {
        $this->request = $request;
        $this->villageService = $villageService;
    }

    public function all($id)
    {
        $items = $this->villageService->getByDistrictId($id);

        return response()->json(['data' => $items, 'success' => true]);
    }
}
