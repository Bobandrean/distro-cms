@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/delivery-order.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.do_date_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.do_number_label')</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $item->kode_do }}"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.po_number_label')</label>
                                <input type="text" class="form-control form-control-sm" value="{{ $item->po->kode_po }}"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.supplier_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->po->pemasok->nama_perusahaan }} ({{ $item->po->pemasok->nama_pic }})"
                                       disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.payment_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->po->tipe_pembayaran->nama }}" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.top_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->po->po_detail->lama_pinjaman }} hari" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="">@lang('pages/delivery-order.form.disbursement_percentage_label')</label>
                                <input type="text" class="form-control form-control-sm"
                                       value="{{ $item->po->persen_metode_pembayaran }} %" disabled>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                {{ $item->po->po_billing->nama_usaha }} <br>
                                {{ $item->po->po_billing->nama_depan }} {{ $item->po->po_billing->nama_belakang }} <br>
                                {{ $item->po->po_billing->msisdn }} <br>
                                {{ $item->po->po_billing->email }} <br> <br>
                                {{ $item->po->po_billing->alamat }}, <br> {{ $item->po->po_billing->provinsi }}
                                , {{ $item->po->po_billing->kota }},
                                {{ $item->po->po_billing->kecamatan }}, {{ $item->po->po_billing->kelurahan }},
                                <br> {{ $item->po->po_billing->kode_pos }}
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                <tr class="text-center">
                                    <th>@lang('pages/delivery-order.detail-table.col_1')</th>
                                    <th>@lang('pages/delivery-order.detail-table.col_2')</th>
                                    <th>@lang('pages/delivery-order.detail-table.col_3')</th>
                                    <th>@lang('pages/delivery-order.detail-table.col_4')</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($item->po->po_barang as $detail)
                                    <tr>
                                        <td>{{ $detail->produk->kode }} - {{ $detail->produk->nama }}</td>
                                        <td class="text-center">{{ number_format($detail->jumlah) }}</td>
                                        <td class="text-right">Rp{{ number_format($detail->harga,2,".",",") }}</td>
                                        <td class="text-right">Rp{{ number_format($detail->total,2,".",",") }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/delivery-order.detail-table.footer.subtotal_label')</td>
                                    <td class="text-right">Rp{{ number_format($item->po->subtotal, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/delivery-order.detail-table.footer.admin_fee_label')</td>
                                    <td class="text-right">
                                        Rp{{ number_format($item->po->biaya_layanan, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/delivery-order.detail-table.footer.interest_fee_label')</td>
                                    <td class="text-right">
                                        Rp{{ number_format($item->po->biaya_bunga, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/delivery-order.detail-table.footer.total_label')</td>
                                    <td class="text-right">Rp{{ number_format($item->po->total, 2, '.', ',') }}</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="{{ route('delivery-order.print', $item->id) }}" class="btn btn-sm btn-warning"><i
                                    class="fas fa-fw fa-print"></i> @lang('global.print_button_txt')</a>

                            @if(session()->get('user')->tipe_akun->slug == 'super_admin' || session()->get('user')->tipe_akun->slug == 'pengiriman')
                                @if($item->status_do == 'Diproses')
                                    <a href="{{ route('delivery-order.onDelivery', $item->id) }}"
                                       onclick="return confirm('@lang("global.confirmation_message")');"
                                       class="btn btn-sm btn-secondary"><i
                                            class="fas fa-fw fa-truck"></i> @lang('global.on_delivery_button_txt')</a>
                                @elseif($item->status_do == 'Dalam Pengiriman')
                                    <a href="#" data-toggle="modal" data-target="#finish" onclick="return confirm('@lang("global.confirmation_message")');"
                                       class="btn btn-sm btn-primary"><i
                                            class="fas fa-fw fa-check-circle"></i> @lang('global.finish_button_txt')</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <form action="{{ route('delivery-order.finish', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal fade" id="finish" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">@lang('pages/delivery-order.form.delivery_attachment_label')</label>
                                <input type="file" name="delivery_attachment" class="form-control form-control-sm">
                            </div>
                            <div class="form-group">
                                <label for="">@lang('pages/delivery-order.form.invoice_attachment_label')</label>
                                <input type="file" name="invoice_attachment" class="form-control form-control-sm">
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
