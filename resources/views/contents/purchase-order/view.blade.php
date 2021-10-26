@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/purchase-order.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/purchase-order.form.po_number_label')</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $item->kode_po }}"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/purchase-order.form.date_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/purchase-order.form.supplier_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->pemasok->nama_perusahaan }} ({{ $item->pemasok->nama_pic }})"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/purchase-order.form.payment_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->tipe_pembayaran->nama }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/purchase-order.form.top_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->po_detail->lama_pinjaman }} hari" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/purchase-order.form.disbursement_percentage_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->persen_metode_pembayaran }} %" disabled>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                {{ $item->po_billing->nama_usaha }} <br>
                                {{ $item->po_billing->nama_depan }} {{ $item->po_billing->nama_belakang }} <br>
                                {{ $item->po_billing->msisdn }} <br>
                                {{ $item->po_billing->email }} <br> <br>
                                {{ $item->po_billing->alamat }}, <br> {{ $item->po_billing->provinsi }}
                                , {{ $item->po_billing->kota }},
                                {{ $item->po_billing->kecamatan }}, {{ $item->po_billing->kelurahan }},
                                <br> {{ $item->po_billing->kode_pos }}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                <tr class="text-center">
                                    <th>@lang('pages/purchase-order.detail-table.col_1')</th>
                                    <th>@lang('pages/purchase-order.detail-table.col_2')</th>
                                    <th>@lang('pages/purchase-order.detail-table.col_3')</th>
                                    <th>@lang('pages/purchase-order.detail-table.col_4')</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($item->po_barang as $detail)
                                    <tr>
                                        <td>{{ $detail->produk->kode }} - {{ $detail->produk->nama }}</td>
                                        <td class="text-center">{{ number_format($detail->jumlah) }}</td>
                                        <td class="text-right">Rp{{ number_format($detail->harga,2,".",",") }}</td>
                                        <td class="text-right">Rp{{ number_format($detail->total,2,".",",") }}</td>
                                    </tr>
                                @endforeach
                               
                                @if(session()->get('payment_id') != '0')
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/purchase-order.detail-table.footer.total_label')</td>
                                    <td class="text-right">Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                </tr>
                                @else
                                <tr>
                                    <tr>
                                        <td colspan="3"
                                            class="text-right">@lang('pages/purchase-order.detail-table.footer.subtotal_label')</td>
                                        <td class="text-right">Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                    </tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/purchase-order.detail-table.footer.admin_fee_label')</td>
                                    <td class="text-right">
                                        Rp{{ number_format($item->biaya_layanan, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/purchase-order.detail-table.footer.interest_fee_label')</td>
                                    <td class="text-right">Rp{{ number_format($item->biaya_bunga, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/purchase-order.detail-table.footer.total_label')</td>
                                    <td class="text-right">Rp{{ number_format($item->total, 2, '.', ',') }}</td>
                                </tr>
                                @endif
                             
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ route('purchase-order.print', $item->id) }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-fw fa-print"></i> Print Invoice</a>
                        <a href="{{ route('purchase-order.print-billing', $item->id) }}" class="btn btn-sm btn-warning"><i
                            class="fas fa-fw fa-print"></i>Print PO</a>

                        @if(session()->get('user')->tipe_akun->slug == 'super_admin' || session()->get('user')->tipe_akun->slug == 'pemasok')
                            @if($item->status_po == 'Menunggu')
                                <a href="{{ route('purchase-order.approve', $item->id) }}" onclick="return confirm('@lang("global.confirmation_message")');"
                                   class="btn btn-sm btn-primary"><i
                                        class="fas fa-fw fa-check"></i> @lang('global.accept_button_txt')</a>
                                <a href="#" data-toggle="modal" data-target="#reject" class="btn btn-sm btn-danger"><i
                                        class="fas fa-fw fa-times"></i> @lang('global.reject_button_txt')</a>
                            @endif
                        @elseif(session()->get('user')->tipe_akun->slug == 'gudang')
                            @if($item->status_po == 'Diterima_Pemasok')
                                <a href="{{ route('purchase-order.approve', $item->id) }}" onclick="return confirm('@lang("global.confirmation_message")');"
                                   class="btn btn-sm btn-primary"><i
                                        class="fas fa-fw fa-check"></i> @lang('global.accept_button_txt')</a>
                                <a href="#" data-toggle="modal" data-target="#reject" class="btn btn-sm btn-danger"><i
                                        class="fas fa-fw fa-times"></i> @lang('global.reject_button_txt')</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('purchase-order.reject', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="reject" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="description" class="form-control form-control-sm" cols="30"
                                      rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal"><i
                                class="fas fa-fw fa-times"></i> @lang('global.cancel_button_txt')</button>
                        <button type="submit" class="btn btn-sm btn-primary"><i
                                class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
