<?php

namespace App\Http\Controllers;

use App\Services\MapService;

class MapController extends Controller
{
    private $mapService;

    public function __construct(MapService $mapService)
    {
        $this->mapService = $mapService;
    }

    public function index()
    {
        return view('contents.map.index');
    }

    public function indexByLatLong($latne, $lngne, $latsw, $lngsw){
        $data['latne'] = $latne;
        $data['lngne'] = $lngne;
        $data['latsw'] = $latsw;
        $data['lngsw'] = $lngsw;

        $items = $this->mapService->getByLatLong($data);

        return response()->json([
            'status' => true,
            'data' => $items
        ]);
    }
}
