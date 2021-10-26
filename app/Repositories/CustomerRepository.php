<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Traits\baseRepositoryTrait;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerRepository
{
    use baseRepositoryTrait;

    /**
     * @var Customer
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param Customer $model
     */
    public function __construct(Customer $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        $query = $this->model->whereHas('users', function ($query) {
            $query->where('id_tipe_akun', '3');
        });

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('relasi_pembeli_pemasok', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('relasi_pembeli_pemasok', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->whereHas('relasi_pembeli_pemasok', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (session()->get('payment_id') != '0'):
            $query = $query->whereHas('tipe_pembayaran_pembeli', function ($q) {
               $q->where('id_pembayaran', session()->get('payment_id'));
            });
        endif;

        $query = $query->get();

        return $query;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['users','users.kaspro_member', 'province', 'regency', 'tipe_pembayaran_pembeli.tipe_pembayaran'])
            ->whereHas('users', function ($query) {
                $query->where('id_tipe_akun', '3');
                $query->where('status', '1');
            });

        if (isset($request['nama_usaha']) && !empty($request['nama_usaha'])):
            $query = $query->where('nama_usaha', 'like', '%'.$request['nama_usaha'].'%');
        endif;

        if (isset($request['nama']) && !empty($request['nama'])):
            $query = $query->whereRaw("CONCAT(nama_depan,' ', nama_belakang) LIKE ?", ['%'.$request->nama.'%']);
        endif;

        if (isset($request['province']) && !empty($request['province'])):
            $query = $query->where('provinsi', $request['province']);
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
            $query = $query->where('kota', $request['regency']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');
        
        return $query;
    }

    public function getByLatLong($request)
    {
        $query = $this->model->leftJoin(DB::raw(
            '(SELECT id_pembeli, SUM(plafon_kredit) as total_plafon FROM tipe_pembayaran_pembeli GROUP BY id_pembeli) sum_plafon'
        ), function($join){
            $join->on('pembeli.id', '=', 'sum_plafon.id_pembeli');
        })
            ->whereRaw('latitude BETWEEN '.$request['latsw'].' AND '.$request['latne'].' AND longitude BETWEEN '.$request['lngsw'].' AND '.$request['lngne'])
            ->where('id_job', '!=', '4')
            ->select('pembeli.nama_kyc', 'pembeli.nama_usaha', 'pembeli.latitude', 'pembeli.longitude', 'sum_plafon.total_plafon')
            ->get();

        return $query;
    }

    public function getNumber($request)
    {
        $query = $this->model;

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        $query = $query->whereHas('users', function ($users) {
            $users->where('status', '1')->where('id_tipe_akun', '3');
        })
            ->count();

        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with(['users.kaspro_member', 'province', 'regency'])
            ->whereHas('users', function ($query) {
                $query->where('id_tipe_akun', '3');
                $query->where('status', '1');
            });

        if (isset($request['nama_usaha']) && !empty($request['nama_usaha'])):
                $query->where('nama_usaha', 'like', '%'.$request['nama_usaha'].'%');
        endif;

        if (isset($request['nama']) && !empty($request['nama'])):
                $query->whereRaw("CONCAT(nama_depan,' ', nama_belakang) LIKE ?", ['%'.$request->nama.'%']);
        endif;

        if (isset($request['province']) && !empty($request['province'])):
                $query->where('provinsi', $request['province']);
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
                $query->where('kota', $request['regency']);
        endif;

        $query = $query->latest('created_at')->get();
        return $query;
    }

    public function getByUserId($userId)
    {
        return $this->model->with('users')->where('id_user', $userId)->first();
    }

    public function getByPaymentId($payment_id, $request)
    {
        $query = $this->model->with(['users','users.kaspro_member', 'province', 'regency', 'tipe_pembayaran_pembeli.tipe_pembayaran'])
            ->whereHas('tipe_pembayaran_pembeli', function ($query) use ($payment_id) {
                $query->where('id_pembayaran', $payment_id);
            })
            ->whereHas('users', function ($query) {
                $query->where('status', '1');
            })
            ->join(DB::raw('(SELECT id_pembeli, SUM(plafon_kredit) as plafon_kredit FROM tipe_pembayaran_pembeli GROUP BY id_pembeli) AS q1'), 'pembeli.id', '=', 'q1.id_pembeli')
            ->orderBy('q1.plafon_kredit', 'ASC');

        if (isset($request['nama_usaha']) && !empty($request['nama_usaha'])):
                $query->where('nama_usaha', 'like', '%'.$request['nama_usaha'].'%');
        endif;

        if (isset($request['nama']) && !empty($request['nama'])):
                $query->whereRaw("CONCAT(nama_depan,' ', nama_belakang) LIKE ?", ['%'.$request->nama.'%']);
        endif;

        if (isset($request['province']) && !empty($request['province'])):
                $query->where('provinsi', $request['province']);
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
                $query->where('kota', $request['regency']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getInactiveCustomer($active)
    {
        $query = $this->model;

        $query = $query->whereHas('users', function ($users) {
                $users->where('status', '1')->where('id_tipe_akun', '3');
            })->whereNotIn('id',$active)->get();

        return $query;
    }
}

