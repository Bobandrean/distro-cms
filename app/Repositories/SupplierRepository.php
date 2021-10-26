<?php

namespace App\Repositories;

use App\Models\Supplier;
use App\Traits\baseRepositoryTrait;

class SupplierRepository
{
    use baseRepositoryTrait;

    /**
     * @var Supplier
     */
    private $model;

    /**
     * UserRepository constructor.
     * @param Supplier $model
     */
    public function __construct(Supplier $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['users', 'job', 'province', 'regency'])
            ->whereHas('users', function ($query) {
                $query->where('id_tipe_akun', '4');
                $query->where('status', '1');
            });

        if (isset($request['username']) && !empty($request['username'])):
            $query = $query->whereHas('users', function ($query) use ($request) {
                $query->where('username', 'like', '%'.$request['username'].'%');
            });
        endif;

        if (isset($request['company_name']) && !empty($request['company_name'])):
            $query->where('nama_perusahaan', 'like', '%'.$request['company_name'].'%');
        endif;

        if (isset($request['pic_name']) && !empty($request['pic_name'])):
            $query->where('nama_pic', 'like', '%'.$request['pic_name'].'%');
        endif;

        if (isset($request['email']) && !empty($request['email'])):
            $query->where('email', 'like', '%'.$request['email'].'%');
        endif;

        if (isset($request['province']) && !empty($request['province'])):
            $query->where('provinsi', $request['province']);
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
            $query->where('kota', $request['regency']);
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function trashedOnlyDatatable($request)
    {
        $query = $this->model->with(['users', 'job', 'province', 'regency'])
            ->whereHas('users', function ($query) {
                $query->where('id_tipe_akun', '4');
                $query->where('status', '0');
            });

        if (isset($request['username']) && !empty($request['username'])):
            $query = $query->whereHas('users', function ($query) use ($request) {
                $query->where('username', 'like', '%'.$request['username'].'%');
            });
        endif;

        if (isset($request['company_name']) && !empty($request['company_name'])):
            $query->where('nama_perusahaan', 'like', '%'.$request['company_name'].'%');
        endif;

        if (isset($request['pic_name']) && !empty($request['pic_name'])):
            $query->where('nama_pic', 'like', '%'.$request['pic_name'].'%');
        endif;

        if (isset($request['email']) && !empty($request['email'])):
            $query->where('email', 'like', '%'.$request['email'].'%');
        endif;

        if (isset($request['province']) && !empty($request['province'])):
            $query->where('provinsi', $request['province']);
        endif;

        if (isset($request['regency']) && !empty($request['regency'])):
            $query->where('kota', $request['regency']);
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getByUserId($userId)
    {
        return $this->model->with(['users', 'job', 'province', 'regency', 'district', 'village'])->where('id_user', $userId)->first();
    }

    public function export($request)
    {
        $query = $this->model->with(['users', 'job', 'province', 'regency'])
            ->whereHas('users', function ($query) {
                $query->where('id_tipe_akun', '4');
                $query->where('status', '1');
            });

        if (isset($request['username']) && !empty($request['username'])):
            $query = $query->whereHas('users', function ($query) use ($request) {
                $query->where('username', 'like', '%'.$request['username'].'%');
            });
        endif;

        if (isset($request['company_name']) && !empty($request['company_name'])):
            $query->where('nama_perusahaan', 'like', '%'.$request['company_name'].'%');
        endif;

        if (isset($request['pic_name']) && !empty($request['pic_name'])):
            $query->where('nama_pic', 'like', '%'.$request['pic_name'].'%');
        endif;

        if (isset($request['email']) && !empty($request['email'])):
            $query->where('email', 'like', '%'.$request['email'].'%');
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

    public function getNumber($request)
    {
        $query = $this->model;

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        $query = $query->whereHas('users', function ($users) {
                $users->where('status', '1')->where('id_tipe_akun', '4');
            })
            ->count();

        return $query;
    }

    public function getInactiveSupplier($active)
    {
        $query = $this->model;

        $query = $query->whereHas('users', function ($users) {
                $users->where('status', '1')->where('id_tipe_akun', '4');
            })->whereNotIn('id',$active)->get();

        return $query;
    }
}

