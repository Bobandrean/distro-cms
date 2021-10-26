<?php

namespace App\Repositories;

use App\Models\PurchaseOrder;
use App\Traits\baseRepositoryTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseOrderRepository
{
    use baseRepositoryTrait;

    /**
     * @var PurchaseOrder
     */
    private $model;

    /**
     * PurchaseOrder constructor.
     * @param PurchaseOrder $model
     */
    public function __construct(PurchaseOrder $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model->with(['pemasok','pembeli','tipe_pembayaran','po_detail']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok)
                ->where('status_po', '!=', 'Menunggu');
        endif;

        if (session()->get('payment_id') != '0'):
            $query = $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        if (isset($request['status']) && !empty($request['status'])):
            $query = $query->where('status_po', $request['status']);
        endif;

        if (isset($request['payment_status']) && !empty($request['payment_status'])):
            $query =$query->whereHas('po_detail', function ($q) use ($request) {
                $q->where('status_pelunasan', $request['payment_status']);
            });
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function export($request)
    {
        $query = $this->model->with(['pemasok','pembeli','tipe_pembayaran','po_detail']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok)
                ->where('status_po', '!=', 'Menunggu');
        endif;

        if (session()->get('user')->tipe_akun->slug == 'kartu_kredit'):
            $query = $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        if (isset($request['status']) && !empty($request['status'])):
            $query = $query->where('status_po', $request['status']);
        endif;

        if (isset($request['payment_status']) && !empty($request['payment_status'])):
            $query =$query->whereHas('po_detail', function ($q) use ($request) {
                $q->where('status_pelunasan', $request['payment_status']);
            });
        endif;

        $query = $query->latest('created_at')->get();
        return $query;
    }

    public function datatableByCustomerId($customer_id)
    {
        $query = $this->model->with(['pemasok','pembeli','tipe_pembayaran','po_detail']);

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('id_pemasok', session()->get('department')->id_pemasok)
                ->where('status_po', '!=', 'Menunggu');
        endif;

        $query = $query->where('id_pembeli', $customer_id)->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function topCustomers($request)
    {
        $query = $this->model
            ->join('pembeli', 'po.id_pembeli', '=', 'pembeli.id')
            ->where('po.status_po', '!=', 'Dibatalkan')
            ->select('pembeli.nama_usaha as nama', DB::raw('SUM(po.subtotal) as total'));

        if (session()->get('user')->tipe_akun->slug == 'pemasok'):
            $query = $query->where('po.id_pemasok', session()->get('department')->id);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'gudang'):
            $query = $query->where('po.id_pemasok', session()->get('department')->id_pemasok);
        endif;

        if (session()->get('user')->tipe_akun->slug == 'pengiriman'):
            $query = $query->where('po.id_pemasok', session()->get('department')->gudang->id_pemasok);
        endif;

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('po.updated_at', $request['year']);
        endif;

        $query =  $query
            ->groupBy('nama')
            ->orderBy('total', 'DESC')
            ->take(10)
            ->get();

        return $query;
    }

    public function totalOrders($request)
    {
        $query = $this->model
            ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang']);

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        $query = $query->sum('total');

        return $query;
    }

    public function subtotalGtv($request)
    {
        $query = $this->model
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');

                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pelunasan', $request['year']);
                endif;
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });

        $query = $query->sum('nilai_pencairan');

        return $query;
    }

    public function subtotalDisbursement($request)
    {
        $query = $this->model
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');

                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pencairan', $request['year']);
                endif;
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });
            if (session()->get('payment_id') != '0'):
                $query->where('id_pembayaran', session()->get('payment_id'));
            endif;

        $query = $query->sum('nilai_pencairan');

        return $query;
    }

    public function subtotalUndisbursement($request)
    {
        $query = $this->model
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Tidak');
                $query->where('status_pelunasan', 'Belum Lunas');
                $query->whereNotNull('tanggal_pencairan_pemasok');

                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pencairan_pemasok', $request['year']);
                endif;
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });
            if (session()->get('payment_id') != '0'):
                $query->where('id_pembayaran', session()->get('payment_id'));
            endif;

        $query = $query->sum('subtotal');

        return $query;
    }

    public function totalLoanRepaid($request)
    {
        $query = $this->model
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');

                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pelunasan', $request['year']);
                endif;
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });

        $query = $query->sum('nilai_pelunasan');

        return $query;
    }

    public function totalLoanRepaidThisMonth($request)
    {
        $query = $this->model
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');
                $query->whereYear('tanggal_pelunasan', Carbon::now()->format('Y'));
                $query->whereMonth('tanggal_pelunasan', Carbon::now()->format('m'));
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });

        $query = $query->sum('nilai_pelunasan');

        return $query;
    }

    public function totalOutstanding($request)
    {
        $query = $this->model
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');
              
                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pencairan', $request['year']);
                endif;
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });

            if (session()->get('payment_id') != '0'):
                $query->where('id_pembayaran', session()->get('payment_id'));
            endif;

        $query = $query->sum('nilai_pencairan');

        return $query;
    }

    public function ongoingTransaction($request)
    {
        $query = $this->model->with(['do'])
                ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang'])
                ->where('id_pembayaran','!=','8')
                ->whereHas('po_detail', function ($query) {
                    $query->where('pencairan', 'Tidak');
                    $query->where('status_pelunasan', 'Belum Lunas');
                })
                ->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
                });

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        $query = $query->sum('subtotal');

        return $query;
    }

    public function newOrders($request)
    {
        $query = $this->model
            ->where('status_po', 'Menunggu');

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        $query = $query->sum('total');

        return $query;
    }

    public function numberOfOrders($request)
    {
        $query = $this->model
            ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang']);

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        $query = $query->count();

        return $query;
    }

    public function outstandings($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');
                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pencairan', $request['year']);
                endif;
                
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });

            if (session()->get('payment_id') != '0'):
                $query->where('id_pembayaran', session()->get('payment_id'));
            endif;

        $query = $query->get();

        return $query;
    }

    public function undisbursements($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Tidak');
                $query->where('status_pelunasan', 'Belum Lunas');
                $query->whereNotNull('tanggal_pencairan_pemasok');

                if (isset($request['year']) && !empty($request['year'])):
                    $query->whereYear('tanggal_pencairan_pemasok', $request['year']);
                endif;
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });
            if (session()->get('payment_id') != '0'):
                $query->where('id_pembayaran', session()->get('payment_id'));
            endif;

        $query = $query->get();

        return $query;
    }

    public function disbursementDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'do', 'pemasok'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');
                $query->whereNotNull('tanggal_pencairan_pemasok');
                $query->orderBy('jatuh_tempo', 'ASC');
            })->whereHas('do', function ($query) use ($request) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

            

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function pendingDisbursementDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'do', 'pemasok'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Tidak');
                $query->where('status_pelunasan', 'Belum Lunas');
                $query->whereNotNull('tanggal_pencairan_pemasok');
            })->whereHas('do', function ($query) use ($request) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->latest('id')->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportDisbursementDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'do', 'pemasok'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');
                $query->whereNotNull('tanggal_pencairan_pemasok');
                $query->orderBy('jatuh_tempo', 'ASC');
            })->whereHas('do', function ($query) use ($request) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->get();

        return $query;
    }

    public function exportPendingDisbursementDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'do', 'pemasok'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Tidak');
                $query->where('status_pelunasan', 'Belum Lunas');
                $query->whereNotNull('tanggal_pencairan_pemasok');
            })->whereHas('do', function ($query) use ($request) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->latest('id')->get();

        return $query;
    }

    public function totalOrdersDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok'])
            ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang'])
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->orderBy('tanggal_pencairan', 'DESC');
            });
            

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportTotalOrdersDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok'])
            ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang']);

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function financedDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->whereIn('status_pelunasan', ['Lunas', 'Belum Lunas']);
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportFinancedDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->whereIn('status_pelunasan', ['Lunas', 'Belum Lunas']);
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->get();

        return $query;
    }

    public function totalLoanRepaidDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');

            if (isset($request['from_rp']) && !empty($request['from_rp'])):
                $query = $query->where('tanggal_pelunasan', '>=', Carbon::parse($request['from_rp'])->format('Y-m-d'));
            endif;
            if (isset($request['to_rp']) && !empty($request['to_rp'])):
                $query = $query->where('tanggal_pelunasan', '<=', Carbon::parse($request['to_rp'])->format('Y-m-d'));
            endif;
            if (isset($request['from_db']) && !empty($request['from_db'])):
                $query = $query->where('tanggal_pencairan', '>=', Carbon::parse($request['from_db'])->format('Y-m-d'));
            endif;
            if (isset($request['to_db']) && !empty($request['to_db'])):
                $query = $query->where('tanggal_pencairan', '<=', Carbon::parse($request['to_db'])->format('Y-m-d'));
            endif;
            })->whereHas('do', function ($query) use ($request)  {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportTotalLoanRepaidDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');

                if (isset($request['from_rp']) && !empty($request['from_rp'])):
                    $query = $query->where('tanggal_pelunasan', '>=', Carbon::parse($request['from_rp'])->format('Y-m-d'));
                endif;
                if (isset($request['to_rp']) && !empty($request['to_rp'])):
                    $query = $query->where('tanggal_pelunasan', '<=', Carbon::parse($request['to_rp'])->format('Y-m-d'));
                endif;
            })->whereHas('do', function ($query) use ($request) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->get();

        return $query;
    }

    public function totalLoanRepaidThisMonthDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');
                $query->whereYear('tanggal_pelunasan', Carbon::now()->format('Y'));
                $query->whereMonth('tanggal_pelunasan', Carbon::now()->format('m'));

                if (isset($request['from_rp']) && !empty($request['from_rp'])):
                    $query = $query->where('tanggal_pelunasan', '>=', Carbon::parse($request['from_rp'])->format('Y-m-d'));
                endif;
                if (isset($request['to_rp']) && !empty($request['to_rp'])):
                    $query = $query->where('tanggal_pelunasan', '<=', Carbon::parse($request['to_rp'])->format('Y-m-d'));
                endif;
                if (isset($request['from_db']) && !empty($request['from_db'])):
                    $query = $query->where('tanggal_pencairan', '>=', Carbon::parse($request['from_db'])->format('Y-m-d'));
                endif;
                if (isset($request['to_db']) && !empty($request['to_db'])):
                    $query = $query->where('tanggal_pencairan', '<=', Carbon::parse($request['to_db'])->format('Y-m-d'));
                endif;
                })->whereHas('do', function ($query) use ($request)  {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportTotalLoanRepaidThisMonthDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Lunas');
                $query->whereYear('tanggal_pelunasan', Carbon::now()->format('Y'));
                $query->whereMonth('tanggal_pelunasan', Carbon::now()->format('m'));

                if (isset($request['from_rp']) && !empty($request['from_rp'])):
                    $query = $query->where('tanggal_pelunasan', '>=', Carbon::parse($request['from_rp'])->format('Y-m-d'));
                endif;
                if (isset($request['to_rp']) && !empty($request['to_rp'])):
                    $query = $query->where('tanggal_pelunasan', '<=', Carbon::parse($request['to_rp'])->format('Y-m-d'));
                endif;
            })->whereHas('do', function ($query) use ($request) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->get();

        return $query;
    }

    public function totalOutstandingDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');
               
            })->whereHas('do', function ($query) use ($request){
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });


        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportTotalOutstandingDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok', 'do'])
            ->where('status_po', 'Diterima_Gudang')
            ->whereHas('po_detail', function ($query) use ($request) {
                $query->where('pencairan', 'Ya');
                $query->where('status_pelunasan', 'Belum Lunas');
            
            })->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
                if (isset($request['do_number']) && !empty($request['do_number'])):
                    $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
                endif;
            });

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->get();

        return $query;
    }

    public function ongoingTransactionDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok','do'])
            ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang'])
            ->where('id_pembayaran','!=','8')
            ->whereHas('po_detail', function ($query) {
                $query->where('pencairan', 'Tidak');
                $query->where('status_pelunasan', 'Belum Lunas');
            })
            ->whereHas('do', function ($query) {
                $query->where('status_do', 'Selesai');
            });

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;


        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportOngoingTransactionDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok'])
        ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang'])
        ->where('id_pembayaran','!=','8')
        ->whereHas('po_detail', function ($query) {
            $query->where('pencairan', 'Tidak');
            $query->where('status_pelunasan', 'Belum Lunas');
        });

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;


        $query = $query->get();

        return $query;
    }

    public function newOrdersDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok'])
            ->where('status_po', 'Menunggu');

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportNewOrdersDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok'])
            ->where('status_po', 'Menunggu');

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        $query = $query->get();

        return $query;
    }

    public function agingDatatable($request)
    {
        if (isset($request['year']) && !empty($request['year'])):
            $now = $request['year'];
        else:
            $now = Carbon::now()->format('Y');
        endif;

        $data = [];
        for($i=1; $i<=12; $i++) {
            $po = $this->model->join('po_detail','po_detail.id_po','=','po.id')
            ->join('do','do.id_po','=','po.id')
            ->select(DB::raw('(SUM(po.subtotal * 0.0025 * (po_detail.lama_pinjaman / 30) + po.biaya_layanan )) as total_margin'))
            ->where('po_detail.status_pelunasan','=','Lunas')
            ->whereYear('po.created_at','=',$now)
            ->whereMonth('po.created_at','=',$i)
            ->first();

            $countpo = $this->model->join('po_detail','po_detail.id_po','=','po.id')
            ->join('do','do.id_po','=','po.id')
            ->whereYear('po.created_at','=',$now)
            ->whereMonth('po.created_at','=',$i)
            ->where('po_detail.status_pelunasan','=','Lunas')
            ->where('do.status_do','=','Selesai')
            ->count();

            $gtvthismonth = $this->model->join('do','po.id','=','do.id_po')
                ->join('po_detail','po_detail.id_po','=','po.id')
                ->where('po_detail.status_pelunasan','=','Lunas')
                ->where('do.status_do','=','Selesai')
                ->whereYear('po_detail.tanggal_pelunasan','=',$now)
                ->whereMonth('po_detail.tanggal_pelunasan','=',$i)
                ->select(DB::raw('SUM(po.nilai_pelunasan) as total_gtv'))
                ->first();

            $countpencairan = $this->model->join('po_detail','po_detail.id_po','=','po.id')
                ->join('do','po.id','=','do.id_po')
                ->where('po_detail.pencairan','=','Ya')
                ->where('po.status_po', '=', 'Diterima_Gudang')
                ->where('do.status_do','=','Selesai')
                ->where('po_detail.status_pelunasan', '=', 'Belum Lunas')
                ->whereYear('po_detail.tanggal_pencairan','=',$now)
                ->whereMonth('po_detail.tanggal_pencairan','=',$i)
                ->select(DB::raw('SUM(po.nilai_pencairan) as subtotal_pencairan'))
                ->first();

            if($i<10){
                $date = "0".$i;
            } else {
                $date = "".$i;
            }

            if($i<12){
                $monthNum  = $i;
                $dateObj   = Carbon::createFromFormat('m', $monthNum);
                $monthName = $dateObj->format('F');
                } else {
                    $monthNum  = $i;
                    $dateObj   = Carbon::createFromFormat('m', $monthNum);
                    $monthName = $dateObj->format('F');
                }


            $current_data = [
                'number' => $date,
                'period' => $monthName,
                'total_margin' => $po->total_margin,
                'po' => $countpo,
                'gtv' => $gtvthismonth->total_gtv,
                'pencairan' => $countpencairan->subtotal_pencairan
            ];
            array_push($data, $current_data);
        }

        // $totalmargin = $this->model->join('po_detail','po_detail.id_po','=','po.id')
        // ->select(DB::raw('(SUM(po.subtotal * 0.0025 * (po_detail.lama_pinjaman / 30) + po.biaya_layanan )) as total_margin'))
        // ->where('po_detail.status_pelunasan','=','Lunas')
        // ->first();

        // $gtvthisyear = $this->model->join('do','po.id','=','do.id_po')
        // ->join('po_detail','po_detail.id_po','=','po.id')
        // ->where('po_detail.status_pelunasan','=','Lunas')
        // ->where('do.status_do','=','Selesai')
        // ->where('po_detail.status_pelunasan','=','Lunas')
        // ->where('do.status_do','=','Selesai')
        // ->whereYear('po_detail.tanggal_pelunasan','=',Carbon::now()->format('Y'))
        // ->select(DB::raw('SUM(subtotal) as total_sales'))
        // ->first();

        return $data;
    }

    public function agingDetail($year, $month)
    {
        $query = $this->model->with(['pemasok', 'pembeli','tipe_pembayaran','tipe_pengiriman','po_billing','po_detail','do'])
        ->whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', $month)
        ->whereHas('po_detail', function ($query) {
            $query->where('status_pelunasan','Lunas');
        })
        ->whereHas('do', function ($query) {
            $query->where('status_do','Selesai');
        })
        ->latest('created_at')
        ->paginate(10, ['*'], 'all');

        return $query;
    }

    public function datatableFinancing($request)
    {
        $query = $this->model->with(['pemasok','pembeli','tipe_pembayaran','po_detail','do']);

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;

        if (isset($request['p2p_status']) && !empty($request['p2p_status'])):
            $query = $query->whereHas('po_detail', function ($query) use ($request) {
                $query->where('status_kreditpro', $request['p2p_status']);
            });
        endif;

        if (isset($request['repayment_status']) && !empty($request['repayment_status'])):
            $query = $query->whereHas('po_detail', function ($query) use ($request) {
                $query->where('status_pelunasan', $request['repayment_status']);
            });
        endif;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function getDataActiveCustomers()
    {
        $query = $this->model->join('pembeli','pembeli.id','=','po.id_pembeli')
                ->join('users','users.id','=','pembeli.id_user')
                ->select('po.id_pembeli')
                ->where('po.tanggal', '>=', Carbon::now()->startOfMonth()->subMonth(5))
                ->where('po.status_po', '!=', 'Dibatalkan')
                ->where('users.status','1')
                ->groupBy('po.id_pembeli');

        $query = $query->get();

        return $query;
    }

    public function getDataActivePrincipal()
    {
        $query = $this->model->with('pemasok')
                ->select('id_pemasok')
                ->where('tanggal', '>=', Carbon::now()->startOfMonth()->subMonth(5))
                ->where('status_po', '!=', 'Dibatalkan')
                ->groupBy('id_pemasok'); ;

        $query->whereHas('pemasok.users', function ($q){
            $q->where('status', '1');
        });

        $query = $query->get();

        return $query;
    }

    public function activeCustomerDatatable($request)
    {
        $query = $this->model->with('pembeli')
            ->select('id_pembeli', DB::raw('COUNT(id_pembeli) as jumlah_transaksi'), DB::raw('SUM(subtotal) as subtotal'))
            ->where('tanggal', '>=', Carbon::now()->startOfMonth()->subMonth(5))
            ->where('status_po', '!=' , 'Dibatalkan')
            ->groupBy('id_pembeli')
            ->orderBy('jumlah_transaksi', 'DESC');

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function activeSupplierDatatable($request)
    {
        $query = $this->model->with('pemasok')
            ->select('id_pemasok', DB::raw('COUNT(id_pemasok) as jumlah_transaksi'), DB::raw('SUM(subtotal) as subtotal'))
            ->where('tanggal', '>=', Carbon::now()->startOfMonth()->subMonth(5))
            ->where('status_po', '!=' , 'Dibatalkan')
            ->groupBy('id_pemasok')
            ->orderBy('jumlah_transaksi', 'DESC');

        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }

    public function exportActiveCustomerDatatable($request)
    {
        $query = $this->model->with('pembeli')
            ->select('id_pembeli', DB::raw('COUNT(id_pembeli) as jumlah_transaksi'), DB::raw('SUM(subtotal) as subtotal'))
            ->where('tanggal', '>=', Carbon::now()->startOfMonth()->subMonth(5))
            ->where('status_po', '!=' , 'Dibatalkan')
            ->groupBy('id_pembeli')
            ->orderBy('jumlah_transaksi', 'DESC');

        $query = $query->get();

        return $query;
    }

    public function exportActiveSupplierDatatable($request)
    {
        $query = $this->model->with('pemasok')
            ->select('id_pemasok', DB::raw('COUNT(id_pemasok) as jumlah_transaksi'), DB::raw('SUM(subtotal) as subtotal'))
            ->where('tanggal', '>=', Carbon::now()->startOfMonth()->subMonth(5))
            ->where('status_po', '!=' , 'Dibatalkan')
            ->groupBy('id_pemasok')
            ->orderBy('jumlah_transaksi', 'DESC');

        $query = $query->get();

        return $query;
    }
    public function totalOverDue($request)
    {
        $query = $this->model
        ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang'])
        ->whereHas('po_detail', function ($query) {
            $query->where('pencairan', 'Tidak');
            $query->where('status_pelunasan', 'Belum Lunas');
            $query->where('jatuh_tempo','>',Carbon::now());
        
        });

        if (isset($request['year']) && !empty($request['year'])):
            $query = $query->whereYear('created_at', $request['year']);
        endif;

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        $query = $query->get();

        return $query;
    }
    public function totalOverDueDatatable($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'pemasok'])
        ->whereIn('status_po', ['Diterima_Pemasok', 'Diterima_Gudang'])
        ->whereHas('po_detail', function ($query) {
            $query->where('pencairan', 'Tidak');
            $query->where('status_pelunasan', 'Belum Lunas');
            $query->where('jatuh_tempo','>',Carbon::now());
        });

        if (session()->get('payment_id') != '0'):
            $query->where('id_pembayaran', session()->get('payment_id'));
        endif;

        if (isset($request['from']) && !empty($request['from'])):
            $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
        endif;

        if (isset($request['to']) && !empty($request['to'])):
            $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
        endif;

        if (isset($request['po_number']) && !empty($request['po_number'])):
            $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
        endif;

        if (isset($request['supplier']) && !empty($request['supplier'])):
            $query = $query->where('id_pemasok', $request['supplier']);
        endif;

        if (isset($request['customer']) && !empty($request['customer'])):
            $query = $query->where('id_pembeli', $request['customer']);
        endif;

        if (isset($request['payment_type']) && !empty($request['payment_type'])):
            $query = $query->where('id_pembayaran', $request['payment_type']);
        endif;


        $query = $query->paginate(10, ['*'], 'all');

        return $query;
    }
    public function totalBorrower()
    {
        $query = $this->model
        ->where('status_po', '!=', 'Dibatalkan')
        ->where('id_pembayaran', session()->get('payment_id'))
        ->groupBy('id_pembeli')
        ->select('id_pembeli')
        ->get();

        return $query;
    }
    public function totalBorrowerDatatables()
    {
        $query = $this->model->join('pembeli','pembeli.id','=','po.id_pembeli')
        ->where('status_po', '!=', 'Dibatalkan')
        ->where('id_pembayaran', session()->get('payment_id'))
        ->groupBy('id_pembeli')
        ->select('nama_usaha','msisdn','email','alamat')
        ->paginate(10);

        return $query;
    }
    public function PoDueDates($request)
    {
      
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'do', 'pemasok'])
        ->where('status_po', 'Diterima_Gudang')
        ->whereHas('po_detail', function ($query) use ($request) {
            $startDate = Carbon::now();
            $endDate = Carbon::now()->addDays(7);
            $query->where('pencairan', 'Ya');
            $query->where('status_pelunasan', 'Belum Lunas');
            $query->whereNotNull('tanggal_pencairan_pemasok');
            $query->whereBetween('jatuh_tempo',[$startDate, $endDate]);
            $query->orderBy('jatuh_tempo', 'ASC');
        })->whereHas('do', function ($query) use ($request) {
            $query->where('status_do', 'Selesai');
            if (isset($request['do_number']) && !empty($request['do_number'])):
                $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
            endif;
        });

    if (session()->get('payment_id') != '0'):
        $query->where('id_pembayaran', session()->get('payment_id'));
    endif;

    if (isset($request['from']) && !empty($request['from'])):
        $query = $query->where('tanggal', '>=', Carbon::parse($request['from'])->format('Y-m-d 00:00:00'));
    endif;

    if (isset($request['to']) && !empty($request['to'])):
        $query = $query->where('tanggal', '<=', Carbon::parse($request['to'])->format('Y-m-d 23:59:59'));
    endif;

    if (isset($request['po_number']) && !empty($request['po_number'])):
        $query = $query->where('kode_po', 'LIKE', '%'.$request['po_number'].'%');
    endif;

    if (isset($request['supplier']) && !empty($request['supplier'])):
        $query = $query->where('id_pemasok', $request['supplier']);
    endif;

    if (isset($request['customer']) && !empty($request['customer'])):
        $query = $query->where('id_pembeli', $request['customer']);
    endif;

    if (isset($request['payment_type']) && !empty($request['payment_type'])):
        $query = $query->where('id_pembayaran', $request['payment_type']);
    endif;

    $query = $query->paginate(10, ['*'], 'all');

    return $query;
    }
    public function OutDatedPo($request)
    {
        $query = $this->model->with(['po_detail', 'pembeli', 'tipe_pembayaran', 'do', 'pemasok'])
        ->where('status_po', 'Diterima_Gudang')
        ->whereHas('po_detail', function ($query) use ($request) {
            $startDate = Carbon::now();
            $query->where('pencairan', 'Ya');
            $query->where('status_pelunasan', 'Belum Lunas');
            $query->whereNotNull('tanggal_pencairan_pemasok');
            $query->where('jatuh_tempo','<=', $startDate);
            $query->orderBy('jatuh_tempo', 'ASC');
        })->whereHas('do', function ($query) use ($request) {
            $query->where('status_do', 'Selesai');
            if (isset($request['do_number']) && !empty($request['do_number'])):
                $query->where('kode_do', 'LIKE', '%'.$request['do_number'].'%');
            endif;
        });

    $query = $query->PAGINATE(10,['*'],'all');

    return $query;
    }
}
