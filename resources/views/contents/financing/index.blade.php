@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/financing.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"
                                   aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span
                                        class="badge badge-secondary">{{ number_format($items->total()) }}</span></a>
                            </li>
                        </ul>
                        <br/>
                        <form action="" method="GET" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="form-label col-md-2">Date</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <input type="date" class="form-control form-control-sm" name="from"
                                               @if(isset($request->from) && !empty($request->from)) value="{{ $request->from }}" @endif>
                                        <input type="date" class="form-control form-control-sm" name="to"
                                               @if(isset($request->to) && !empty($request->to)) value="{{ $request->to }}" @endif>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-label" for="">PO Number</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control form-control-sm" name="po_number"
                                           placeholder="PO Number"
                                           @if(isset($request->po_number) && !empty($request->po_number)) value="{{ $request->po_number }}" @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 form-label" for="">Payment Type</label>
                                <div class="col-md-10">
                                    <select name="payment_type" class="form-control form-control-sm">
                                        <option value="">@lang('global.all_selectbox_txt')</option>
                                        @foreach($payments as $payment)
                                            <option value="{{ $payment->id }}" @if(isset($request->payment_type) && $request->payment_type == $payment->id) selected @endif>{{ $payment->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-md-2">P2P Status</label>
                                <div class="col-md-10">
                                    <select name="p2p_status" class="form-control form-control-sm">
                                        <option value="">@lang('global.all_selectbox_txt')</option>
                                        <option value="Menunggu" @if(isset($request->p2p_status) && $request->p2p_status == 'Menunggu') selected @endif>Menunggu</option>
                                        <option value="Diterima" @if(isset($request->p2p_status) && $request->p2p_status == 'Diterima') selected @endif>Diterima</option>
                                        <option value="Ditolak" @if(isset($request->p2p_status) && $request->p2p_status == 'Ditolak') selected @endif>Ditolak</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="form-label col-md-2" for="">Repayment Status</label>
                                <div class="col-md-10">
                                    <select name="repayment_status" class="form-control form-control-sm">
                                        <option value="" selected>@lang('global.all_selectbox_txt')</option>
                                        <option value="Lunas" @if(isset($request->repayment_status) && $request->repayment_status == 'Lunas') selected @endif>Lunas</option>
                                        <option value="Belum Lunas" @if(isset($request->repayment_status) && $request->repayment_status == 'Belum Lunas') selected @endif>Belum Lunas</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                            </button>
                            <a href="{{ route('financing.index') }}" class="btn btn-sm btn-danger ml-2"><i
                                    class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')</a>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                    <div class="my-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <caption>{{ $items->withQueryString()->links() }}</caption>
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('pages/financing.table.col_1')</th>
                                                    <th>@lang('pages/financing.table.col_2')</th>
                                                    <th>@lang('pages/financing.table.col_3')</th>
                                                    <th>@lang('pages/financing.table.col_4')</th>
                                                    <th>@lang('pages/financing.table.col_5')</th>
                                                    <th>@lang('pages/financing.table.col_6')</th>
                                                    <th>@lang('pages/financing.table.col_7')</th>
                                                    <th>@lang('pages/financing.table.col_8')</th>
                                                    <th>@lang('pages/financing.table.col_9')</th>
                                                    <th>@lang('pages/financing.table.col_10')</th>
                                                    <th>@lang('pages/financing.table.col_11')</th>
                                                    <th>@lang('pages/financing.table.col_12')</th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            {{ $item->kode_po }}<br><br>
                                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}
                                                            <br><br>
                                                            {{ $item->tipe_pembayaran->nama}}
                                                        </td>
                                                        <td style="vertical-align: top;">
                                                            {{ $item->pemasok->nama_bank }} <br><br>
                                                            {{ $item->pemasok->nomor_rekening }} <br><br>
                                                            {{ $item->pemasok->nama_pemegang_rekening }}
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            {{ $item->pemasok->nama_perusahaan }} <br><br>
                                                        </td>
                                                        <td style="vertical-align: top;">

                                                            {{ $item->pembeli->nama_usaha }}
                                                            ({{ $item->pembeli->nama_depan }} {{$item->pembeli->nama_belakang}}
                                                            )
                                                        </td>
                                                        <td style="vertical-align: top;">
                                                            <b>Subtotal:</b> <br>
                                                            Rp{{ number_format($item->subtotal,2,".",",") }} <br><br>
                                                            <b>Layanan:</b> <br>
                                                            Rp{{ number_format($item->biaya_layanan,2,".",",") }}
                                                            <br><br>
                                                            <b>Total:</b> <br>
                                                            Rp{{ number_format($item->total,2,".",",") }} <br><br>

                                                        </td>
                                                        <td style="vertical-align: top;">
                                                            <b>Persentase:</b>
                                                            <br> {{ number_format($item->persen_metode_pembayaran) }}%
                                                            <br><br>
                                                            <b>Pembiayaan:</b> <br>
                                                            Rp{{ number_format($item->persen_metode_pembayaran/100 * $item->subtotal,2,".",",")}}
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                               href="{{ route('financing-inv-apps.edit', $item->id) }}"
                                                               style="color:white; width:100%;">Upload</a> <br><br>
                                                            <b>Tanggal: </b><br> @if($item->po_detail->tanggal_upload_po == null)
                                                                - @else {{ \Carbon\Carbon::parse($item->po_detail->tanggal_upload_po)->format('Y-m-d') }} <br>
                                                                <br> @endif
                                                            <b>Berkas: </b><br> @if($item->po_detail->berkas_po == null)
                                                                - @else <a href="{{ $item->po_detail->berkas_po }}"
                                                                           target="_blank">Lihat Berkas</a> @endif
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                               href="{{ route('financing-inv-princ.edit', $item->id) }}"
                                                               style="color:white; width:100%;">Upload</a> <br><br>

                                                            <b>Tanggal: </b><br>
                                                            @if($item->po_detail->tanggal_upload_invoice == null)
                                                                -
                                                            @else
                                                                {{ \Carbon\Carbon::parse($item->po_detail->tanggal_upload_invoice)->format('Y-m-d') }}
                                                            @endif
                                                            <br>

                                                            <b>Berkas: </b><br>@if($item->po_detail->berkas_invoice == null)
                                                                - @else <a
                                                                    href="{{ $item->po_detail->berkas_invoice }}"
                                                                    target="_blank">Lihat
                                                                    Berkas</a> @endif <br>
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            <a target="_blank" class="btn btn-sm btn-primary"
                                                               href="{{ route('financing-p2p.edit', $item->id) }}"
                                                               style="color:white; width:100%;">Edit</a>

                                                            <br> <br>
                                                            @if($item->po_detail->status_kreditpro == 'Menunggu')
                                                                <span
                                                                    class="badge badge-info"
                                                                    style="width:100%"> {{  $item->po_detail->status_kreditpro }}</span> @elseif($item->po_detail->status_kreditpro == 'Diterima')
                                                                <span class="badge badge-primary"
                                                                      style="width:100%">{{ $item->po_detail->status_kreditpro }} </span> @elseif($item->po_detail->status_kreditpro == 'Ditolak')
                                                                <span class="badge badge-danger"
                                                                      style="width:100%">{{ $item->po_detail->status_kreditpro }}  </span> @endif
                                                            <br>
                                                            <br>
                                                            <b>Tanggal: </b><br> {{ \Carbon\Carbon::parse($item->po_detail->tanggal_status)->format('Y-m-d') }}
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            <b>Tanggal
                                                                Invoice: </b><br> @if($item->po_detail->tanggal_invoice == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%"> - </span> @else {{ \Carbon\Carbon::parse($item->tanggal_invoice)->format('Y-m-d') }} @endif
                                                            <br>
                                                            <br>
                                                            <b>Lama
                                                                Pinjaman: </b><br> @if($item->po_detail->lama_pinjaman == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%"> - </span> @elseif($item->po_detail->lama_pinjaman == '60')
                                                                <span class="badge badge-primary" style="width:100%">{{ $item->po_detail->lama_pinjaman }} hari</span> @elseif($item->po_detail->lama_pinjaman ==  '30')
                                                                <span class="badge badge-info" style="width:100%">{{ $item->po_detail->lama_pinjaman }} hari </span> @endif
                                                            <br>
                                                            <br>
                                                            <b>Jatuh
                                                                Tempo: </b><br> @if($item->po_detail->jatuh_tempo == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%"> - </span> @else {{ $item->po_detail->jatuh_tempo }} @endif
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            @if($item->po_detail->status_kreditpro != 'Menunggu')
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                   href="{{ route('financing-disbursement.edit', $item->id) }}"
                                                                   style="color:white;
                                                            width:100%;">Edit</a>
                                                            @else
                                                                <button disabled class="btn btn-sm btn-primary"
                                                                   style="color:white;
                                                        width:100%;">Edit</button>
                                                            @endif

                                                            <br> <br>

                                                            @if($item->po_detail->status_kreditpro != 'Menunggu')
                                                                <a href="{{ route('financing-upload-disbursement-transfer.edit', $item->id) }}" target="_blank" class="btn btn-sm btn-primary mt-3">Bukti Transfer</a>
                                                            @else
                                                                    <button disabled class="btn btn-sm btn-primary mt-3">Bukti Transfer</button>
                                                            @endif
                                                                    <br> <br>
                                                            <b>Bukti Trf Pencairan:</b> <br>
                                                            @if($item->po_detail->bukti_transfer_pencairan == null)
                                                                -
                                                            @else
                                                                <a href="{{ $item->po_detail->bukti_transfer_pencairan }}" target="_blank">Lihat Berkas</a>
                                                            @endif
                                                                <br> <br>

                                                            <b>Tgl Pencairan ke
                                                                Pemasok: </b><br> @if($item->po_detail->tanggal_pencairan_pemasok == null)
                                                                - @else {{ \Carbon\Carbon::parse($item->po_detail->tanggal_pencairan_pemasok)->format('Y-m-d') }} @endif
                                                            <br>
                                                            <b>Pencairan: </b><br> @if($item->po_detail->pencairan == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%"> - </span> @elseif($item->po_detail->pencairan == 'Ya')
                                                                <span class="badge badge-primary"
                                                                      style="width:100%"> Sudah </span> @elseif($item->po_detail->pencairan == 'Tidak')
                                                                <span class="badge badge-danger" style="width:100%"> Belum</span>  @endif
                                                            <br>
                                                            <br>
                                                            <b>Tanggal: </b><br> @if($item->po_detail->tanggal_pencairan == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%;"> - </span> @else {{ \Carbon\Carbon::parse($item->po_detail->tanggal_pencairan)->format('Y-m-d') }} @endif
                                                            <br>
                                                            <br>
                                                            <b>Nilai Pencairan: </b><br>
                                                            Rp.{{ number_format($item->nilai_pencairan) }}
                                                        </td>

                                                        <td style="vertical-align: top;">
                                                            @if( $item->status_po == 'Diterima_Gudang' && $item->po_detail->status_kreditpro == 'Diterima')
                                                                <a target="_blank" class="btn btn-sm btn-primary"
                                                                   href="{{ route('financing-repayment.edit', $item->id) }}"
                                                                   style="color:white; width:100%;">Edit</a>
                                                                <br><br>
                                                            @else
                                                            <button type="button" class="btn btn-sm btn-primary" disabled style="color:white; width:100%;">Edit</button>
                                                         <br><br>

                                                            @endif

{{--                                                            <a href="{{ route('financing-upload-repayment-transfer.edit', $item->id) }}" target="_blank" class="btn btn-sm btn-primary mt-3">Bukti Transfer</a>--}}
{{--                                                                <br> <br>--}}
                                                            <b>Bukti Trf Pelunasan:</b> <br>
                                                            @if($item->po_detail->berkas_pelunasan == null)
                                                                -
                                                            @else
                                                                <a href="{{ $item->po_detail->berkas_pelunasan }}" target="_blank">Lihat Berkas</a>
                                                            @endif
                                                                <br> <br>

                                                            <b>Status: </b><br> @if($item->po_detail->status_pelunasan == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%"> - </span> @elseif($item->po_detail->status_pelunasan == 'Lunas')
                                                                <span class="badge badge-primary"
                                                                      style="width:100%">  {{ $item->po_detail->status_pelunasan }}</span> @elseif($item->po_detail->status_pelunasan == 'Belum Lunas')
                                                                <span class="badge badge-danger"
                                                                      style="width:100%"> {{ $item->po_detail->status_pelunasan }}</span> @endif
                                                            <br>
                                                            <br>
                                                            <b>Tanggal: </b><br> @if($item->po_detail->tanggal_pelunasan == null)
                                                                <span
                                                                    class="badge badge-danger"
                                                                    style="width:100%"> - </span> @else {{ \Carbon\Carbon::parse($item->po_detail->tanggal_pelunasan)->format('Y-m-d') }} @endif
                                                            <br>
                                                            <br>
                                                            <b>Nilai Pelunasan: </b><br>
                                                            Rp.{{ number_format($item->nilai_pelunasan) }}
                                                            <br> <br>
                                                            <b>Catatan: </b><br>
                                                            <span class="text-danger">{{ strip_tags($item->po_detail->catatan) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
