@extends('layout')

<style>
    label {
        font-weight: 600;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/document.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Company Information</h4>
                        <div style="border: 1px solid #dee2e6;padding:15px;margin:5px;">
                            <div class="form-group text-center">
                                <label>Company Photo</label><br/>
                                <img src="{{ $items->foto_toko }}" width="200" alt="">
                            </div>
                            <div class="form-group">
                                <label>Name</label><br/>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $items->nama_depan }} {{$items->nama_belakang }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Company Name</label><br/>
                                <input type="text" class="form-control form-control-sm" value="{{ $items->nama_usaha }}"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label><br/>
                                <input type="text" class="form-control form-control-sm" value="{{ $items->msisdn }}"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label>Email</label><br/>
                                <input type="text" class="form-control form-control-sm" value="{{ $items->email }}"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label>Address</label><br/>
                                <input type="text" class="form-control form-control-sm" value="{{ $items->alamat }}"
                                       disabled>
                            </div>
                            <div class="form-group">
                                <label>Post Code</label><br/>
                                <input type="text" class="form-control form-control-sm" value="{{ $items->kode_pos }}"
                                       disabled>
                            </div>
                        </div>
                        <br/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"
                                   aria-controls="tab1" aria-selected="true">Legal Information</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                                   aria-selected="true">Financial Information</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-controls="tab3"
                                   aria-selected="true">Other Information</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <form action="{{ route('document.upload-legal', $items->id) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="my-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Akta Pendirian</label> <br/>
                                                    @if($items->foto_akta_pendirian)
                                                        <a href="{{ $items->foto_akta_pendirian }}" target="_blank">
                                                            View
                                                            
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="akta_pendirian">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Akta Perubahan (Apabila ada)</label> <br/>
                                                    @if($items->foto_akta_perubahan)
                                                        <a href="{{ $items->foto_akta_perubahan }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="akta_perubahan">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>NIB</label> <br/>
                                                    @if($items->foto_nib)
                                                        <a href="{{ $items->foto_nib }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="nib">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>TDP</label> <br/>
                                                    @if($items->foto_tdp)
                                                        <a href="{{ $items->foto_tdp }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="tdp">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>SIUP</label> <br/>
                                                    @if($items->foto_siup)
                                                        <a href="{{ $items->foto_siup }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="siup">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>NPWP Perusahaan</label> <br/>
                                                    @if($items->foto_npwp_perusahaan)
                                                        <a href="{{ $items->foto_npwp_perusahaan }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="npwp_perusahaan">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Surat Pengukuhan Pengusaha Kena Pajak</label> <br/>
                                                    @if($items->foto_spkp)
                                                        <a href="{{ $items->foto_spkp }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="spkp">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>KTP Pengurus / PIC</label> <br/>
                                                    @if($items->foto_ktp_pic)
                                                        <a href="{{ $items->foto_ktp_pic }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="ktp_pic">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>NPWP Pengurus / PIC</label> <br/>
                                                    @if($items->foto_npwp_pic)
                                                        <a href="{{ $items->foto_npwp_pic }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="npwp_pic">
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label>Surat Keterangan Domisili Perusahaan</label> <br/>
                                                    @if($items->foto_skdp)
                                                        <a href="{{ $items->foto_skdp }}" target="_blank">
                                                            View
                                                        </a>
                                                        <span class="badge badge-success"> Done </span> 
                                                    @endif

                                                    @if(session()->get('payment_id') == '0')
                                                        <input type="file" name="skdp">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Surat Lampiran Kemenkumham</label> <br/>
                                                @if($items->foto_sk_kemenkumham)
                                                <a href="{{ $items->foto_sk_kemenkumham }}" target="_blank">
                                                    View
                                                </a>
                                                <span class="badge badge-success"> Done </span> 
                                                @endif

                                                @if(session()->get('payment_id') == '0')
                                                <input type="file" name="sk_kemenkumham">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(session()->get('payment_id') == '0')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-fw fa-save"></i> @lang('global.upload_button_txt')
                                        </button>
                                    @endif
                                </form>
                            </div>

                            <div class="tab-pane fade show" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <form action="{{ route('document.upload-accounting', $items->id) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="my-3">
                                        <div class="form-group">
                                            <label>Rekening Koran (6 Bulan Terakhir)</label> <br/>
                                            @if($items->foto_rekening_koran)
                                                <a href="{{ $items->foto_rekening_koran }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="rekening_koran">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Laporan Keuangan (3 Tahun Terakhir)</label> <br/>
                                            @if($items->foto_laporan_keuangan)
                                                <a href="{{ $items->foto_laporan_keuangan }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="laporan_keuangan">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Bukti Transaksi dengan Principal (6 Bulan Terakhir)</label> <br/>
                                            @if($items->foto_bukti_transaksi)
                                                <a href="{{ $items->foto_bukti_transaksi }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="bukti_transaksi">
                                            @endif
                                        </div>
                                    </div>
                                    @if(session()->get('payment_id') == '0')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-fw fa-save"></i> @lang('global.upload_button_txt')
                                        </button>
                                    @endif
                                </form>
                            </div>

                            <div class="tab-pane fade show" id="tab3" role="tabpanel" aria-labelledby="tab3">
                                <form action="{{ route('document.upload-other', $items->id) }}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="my-3">
                                        <div class="form-group">
                                            <label>Foto Perusahaan</label> <br/>
                                            @if($items->foto_perusahaan)
                                                <a href="{{ $items->foto_perusahaan }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="foto_perusahaan">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>TTD Digital Via Aplikasi PrivyID</label> <br/>
                                            @if($items->foto_ttd_digital)
                                                <a href="{{ $items->foto_ttd_digital }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="ttd">
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>MOU Distributor dengan Kreditpro</label> <br/>
                                            @if($items->foto_mou)
                                                <a href="{{ $items->foto_mou }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="mou">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>MOU Principle dengan Distributor</label> <br/>
                                            @if($items->foto_mou)
                                                <a href="{{ $items->foto_mou2 }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="mou2">
                                            @endif
                                        </div>  


                                        <div class="form-group">
                                            <label>Company Profile</label> <br/>
                                            @if($items->company_profile)
                                                <a href="{{ $items->company_profile }}" target="_blank">
                                                    View
                                                </a>
                                            @endif

                                            @if(session()->get('payment_id') == '0')
                                                <input type="file" name="company_profile">
                                            @endif
                                        </div>

                                        

                                        <div class="form-group">
                                            <label>Last Updated :</label> <br/> 
                                            {{ \Carbon\Carbon::parse($items->updated_at)->format('Y-m-d') }}

                                           
                                        </div>  
                                    </div>
                                    @if(session()->get('payment_id') == '0')
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fas fa-fw fa-save"></i> @lang('global.upload_button_txt')
                                        </button>
                                    @endif
                                </form>
                            </div>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
