<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'pembeli';

    protected $fillable = [
        'id_user',
        'id_job',
        'rate',
        'nama_depan',
        'nama_belakang',
        'nama_usaha',
        'msisdn',
        'email',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'latitude',
        'longitude',
        'nama_kyc',
        'no_identitas',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pekerjaan',
        'warga_negara',
        'agama',
        'status_kawin',
        'golongan_darah',
        'masa_berlaku',
        'alamat_kyc',
        'provinsi_kyc',
        'kota_kyc',
        'kecamatan_kyc',
        'kelurahan_kyc',
        'kode_pos_kyc',
        'foto_toko',
        'foto_diri',
        'foto_ktp',
        'foto_tanda_tangan',
        'foto_form_badan_usaha',
        'foto_akta_pendirian',
        'foto_akta_perubahan',
        'foto_nib',
        'foto_tdp',
        'foto_siup',
        'foto_npwp_perusahaan',
        'foto_spkp',
        'foto_ktp_pic',
        'foto_npwp_pic',
        'foto_skdp',
        'foto_rekening_koran',
        'foto_laporan_keuangan',
        'foto_bukti_transaksi',
        'foto_perusahaan',
        'foto_ttd_digital',
        'foto_mou',
        'foto_mou2',
        'company_profile',
        'foto_sk_kemenkumham',
        'bayar_tunda'
    ];

    public function keranjang()
    {
        return $this->hasMany(Cart::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'id_job');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'provinsi');
    }

    public function regency()
    {
        return $this->belongsTo(Regency::class, 'kota');
    }

    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'kecamatan');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Village::class, 'kelurahan');
    }

    public function po()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function relasi_pembeli_pemasok()
    {
        return $this->hasMany(CustomerSupplierRelation::class, 'id_pembeli');
    }

    public function saran_dan_keluhan()
    {
        return $this->hasMany(Ticket::class);
    }

    public function tipe_pembayaran_hari()
    {
        return $this->hasMany(PaymentTypeDay::class);
    }

    public function tipe_pembayaran_metode()
    {
        return $this->hasMany(PaymentTypeMethod::class);
    }

    public function tipe_pembayaran_pembeli()
    {
        return $this->hasMany(PaymentTypeCustomer::class, 'id_pembeli');
    }
}
