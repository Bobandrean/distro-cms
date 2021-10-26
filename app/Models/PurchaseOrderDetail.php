<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;

    protected $table = 'po_detail';

    protected $fillable = [
        'id_po',
        'upload_po',
        'tanggal_upload_po',
        'berkas_po',
        'status_kreditpro',
        'tanggal_status',
        'upload_invoice',
        'tanggal_upload_invoice',
        'berkas_invoice',
        'tanggal_invoice',
        'lama_pinjaman',
        'jatuh_tempo',
        'tanggal_pencairan_pemasok',
        'pencairan',
        'tanggal_pencairan',
        'status_pelunasan',
        'berkas_pelunasan',
        'tanggal_pelunasan',
        'catatan',
        'bukti_transfer_pencairan',
        'bukti_transfer_pelunasan'
    ];

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'id_po');
    }
}
