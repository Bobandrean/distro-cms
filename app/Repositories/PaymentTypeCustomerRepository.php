<?php

namespace App\Repositories;

use App\Models\PaymentTypeCustomer;
use App\Traits\baseRepositoryTrait;
use Illuminate\Support\Facades\DB;

class PaymentTypeCustomerRepository
{
    use baseRepositoryTrait;

    /**
     * @var PaymentTypeCustomer
     */
    private $model;

    /**
     * PaymentTypeCustomer constructor.
     * @param PaymentTypeCustomer $model
     */
    public function __construct(PaymentTypeCustomer $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function totalPlafon($request)
    {
        $query = $this->model;

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        $query = $query->sum('plafon_kredit');

        return $query;
    }

    public function datatableGroupByPaymentType()
    {
        return $this->model
            ->join('tipe_pembayaran', 'tipe_pembayaran.id', '=', 'tipe_pembayaran_pembeli.id_pembayaran')
            ->groupBy('tipe_pembayaran_pembeli.id_pembayaran')
            ->select(
                'tipe_pembayaran.*',
                DB::raw('SUM(tipe_pembayaran_pembeli.plafon_kredit) as total_plafon_kredit'),
                DB::raw('SUM(tipe_pembayaran_pembeli.sisa_plafon) as total_sisa_plafon'),
                DB::raw('COUNT(tipe_pembayaran_pembeli.id) as total_customer')
            )
            ->get();
    }

    public function getByPaymentTypeId($id, $request)
    {
        $query = $this->model->with('pembeli', 'tipe_pembayaran');

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
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

        $query = $query->where('id_pembayaran', $id)->latest('created_at')->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportByPaymentTypeId($id, $request)
    {
        $query = $this->model->with('pembeli', 'tipe_pembayaran');

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
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

        $query = $query->where('id_pembayaran', $id)->latest('created_at')->get();

        return $query;
    }

    public function getCreditInfo($customerId, $paymentId)
    {
        return $this->model->where('id_pembeli', $customerId)->where('id_pembayaran', $paymentId)->first();
    }

    public function destroyByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->model->where('id_pembeli', $customerId)->where('id_pembayaran', $paymentId)->delete();
    }
}
