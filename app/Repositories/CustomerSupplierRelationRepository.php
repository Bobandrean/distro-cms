<?php

namespace App\Repositories;

use App\Models\CustomerSupplierRelation;
use App\Traits\baseRepositoryTrait;

class CustomerSupplierRelationRepository
{
    use baseRepositoryTrait;

    /**
     * @var CustomerSupplierRelation
     */
    private $model;

    /**
     * CustomerSupplierRelation constructor.
     * @param CustomerSupplierRelation $model
     */
    public function __construct(CustomerSupplierRelation $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getDistributorsbySupplierId($id, $request)
    {
        $query = $this->model->with(['pembeli', 'tipe_pembeli', 'pemasok']);

        if (isset($request['distributor']) && !empty($request['distributor'])):
            $query = $query->where('id_pembeli', $request['distributor']);
        endif;

        if (isset($request['buyer_type']) && !empty($request['buyer_type'])):
            $query = $query->where('id_tipe_pembeli', $request['buyer_type']);
        endif;

        if (isset($request['province']) && !empty($request['province'])):
            $query = $query->whereHas('pembeli', function ($query) use ($request) {
                $query->where('provinsi', $request['province']);
            });
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
            $query = $query->whereHas('pembeli', function ($query) use ($request) {
                $query->where('kota', $request['regency']);
            });
        endif;

        $query = $query->where('id_pemasok', $id)->latest('created_at')->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportDistributorsBySupplierId($id, $request)
    {
        $query = $this->model->with(['pembeli', 'tipe_pembeli', 'pemasok']);

        if (isset($request['distributor']) && !empty($request['distributor'])):
            $query = $query->where('id_pembeli', $request['distributor']);
        endif;

        if (isset($request['buyer_type']) && !empty($request['buyer_type'])):
            $query = $query->where('id_tipe_pembeli', $request['buyer_type']);
        endif;

        if (isset($request['province']) && !empty($request['province'])):
            $query = $query->whereHas('pembeli', function ($query) use ($request) {
                $query->where('provinsi', $request['province']);
            });
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
            $query = $query->whereHas('pembeli', function ($query) use ($request) {
                $query->where('kota', $request['regency']);
            });
        endif;

        $query = $query->where('id_pemasok', $id)->latest('created_at')->get();

        return $query;
    }

    public function getByCustomerId(int $customer_id)
    {
        $query = $this->model->where('id_pembeli', $customer_id)->get();

        return $query;
    }
}
