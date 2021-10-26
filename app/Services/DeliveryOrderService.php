<?php

namespace App\Services;

use App\Repositories\DeliveryOrderRepository;

class DeliveryOrderService
{
    /**
     * @var DeliveryOrderRepository
     */
    private $deliveryOrderRepository;

    /**
     * DeliveryOrderService constructor.
     * @param DeliveryOrderRepository $deliveryOrderRepository
     */

    public function __construct(DeliveryOrderRepository $deliveryOrderRepository)
    {
        $this->deliveryOrderRepository = $deliveryOrderRepository;
    }

    public function all()
    {
        return $this->deliveryOrderRepository->all();
    }

    public function datatable($request)
    {
        return $this->deliveryOrderRepository->datatable($request);
    }
    public function datatableHistory($request)
    {
        return $this->deliveryOrderRepository->datatableHistory($request);
    }

    public function getById($id)
    {
        return $this->deliveryOrderRepository->getById($id);
    }

    public function getByIdWith($id)
    {
        return $this->deliveryOrderRepository->getByIdWith($id, ['po','po.pemasok','po.pembeli','po.tipe_pembayaran','po.tipe_pengiriman','po.po_barang.produk','po.po_billing']);
    }

    public function store($data)
    {
        return $this->deliveryOrderRepository->store($data);
    }

    public function update($id, $data)
    {
        return $this->deliveryOrderRepository->update($id, $data);
    }

    public function destroy($id)
    {
        return $this->deliveryOrderRepository->destroy($id);
    }

    public function export($request)
    {
        return $this->deliveryOrderRepository->export($request);
    }

    public function exportHistory($request)
    {
        return $this->deliveryOrderRepository->exportHistory($request);
    }
}
