<?php

namespace App\Repositories;

use App\Models\DeliveryOrder;
use App\Traits\baseRepositoryTrait;
use Carbon\Carbon;

class DeliveryOrderRepository
{
    use baseRepositoryTrait;

    /**
     * @var DeliveryOrder
     */
    private $model;

    /**
     * DeliveryOrder constructor.
     * @param DeliveryOrder $model
     */
    public function __construct(DeliveryOrder $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['po.pembeli']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->gudang->id_pemasok);
            });
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['do_number']) && !empty($request['do_number'])):
            $query = $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
            });
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('id_pembeli', $request['customer']);
            });
        endif;

        if (isset($request['status']) && !empty($request['status'])):
            $query = $query->where('status_do', $request['status']);
        endif;

        $query = $query->where('status_do', '!=', 'Selesai')->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with(['po.pembeli']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->gudang->id_pemasok);
            });
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['do_number']) && !empty($request['do_number'])):
            $query = $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
            });
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('id_pembeli', $request['customer']);
            });
        endif;

        if (isset($request['status']) && !empty($request['status'])):
            $query = $query->where('status_do', $request['status']);
        endif;

        $query = $query->where('status_do', '!=', 'Selesai')->get();
        return $query;
    }

    public function datatableHistory($request)
    {
        $query = $this->model->with(['po.pembeli']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->gudang->id_pemasok);
            });
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['do_number']) && !empty($request['do_number'])):
            $query = $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
            });
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('id_pembeli', $request['customer']);
            });
        endif;

        $query = $query->where('status_do', 'Selesai')->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }
    public function exportHistory($request)
    {
        $query = $this->model->with(['po.pembeli']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->id_pemasok);
            });
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->whereHas('po', function ($query) {
                $query->where('id_pemasok', session()->get('department')->gudang->id_pemasok);
            });
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['do_number']) && !empty($request['do_number'])):
            $query = $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
            });
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->whereHas('po', function ($query) use ($request) {
                $query->where('id_pembeli', $request['customer']);
            });
        endif;

    $query = $query->where('status_do', 'Selesai')->latest('created_at')->get();
        return $query;
    }

}
