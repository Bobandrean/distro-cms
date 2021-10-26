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
                                <tr>
                                    <td colspan="3"
                                        class="text-right">@lang('pages/purchase-order.detail-table.footer.subtotal_label')</td>
                                    <td class="text-right">Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                </tr>
                                <tr>
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
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ route('purchase-order.print', $item->id) }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-fw fa-print"></i> Print Invoice</a>
                        <a href="{{ route('purchase-order.print-billing', $item->id) }}" class="btn btn-sm btn-warning"><i
                                class="fas fa-fw fa-print"></i>Print PO</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
