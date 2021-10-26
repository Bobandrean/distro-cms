<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

class MapService
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * MapService constructor.
     * @param CustomerRepository $customerRepository
     */

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getByLatLong($request)
    {
        $buyers = $this->customerRepository->getByLatLong($request);

        $markers = [];
        foreach($buyers as $buyer){
            $current_buyer['latitude'] = (float)$buyer->latitude;
            $current_buyer['longitude'] = (float)$buyer->longitude;
            $current_buyer['title'] = $buyer->nama_usaha;
            $current_buyer['info'] = 'Nama PIC : '.$buyer->nama_kyc.'</br>Nama Usaha : '.$buyer->nama_usaha.'</br>Total Plafon : Rp.'.number_format($buyer->total_plafon,2,',','.');
            array_push($markers, $current_buyer);
        }

        return $markers;
    }
}
