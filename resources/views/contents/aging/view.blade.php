@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/aging.title')
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
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                            <caption>{{ $items->withQueryString()->links() }}</caption>
                                            <thead class="thead-light">
                                            <tr>
                                                <th>@lang('pages/aging.detail-table.col_1')</th>
                                                <th>@lang('pages/aging.detail-table.col_2')</th>
                                                <th>@lang('pages/aging.detail-table.col_3')</th>
                                                <th>@lang('pages/aging.detail-table.col_4')</th>
                                                <th>@lang('pages/aging.detail-table.col_5')</th>
                                                <th>@lang('pages/aging.detail-table.col_6')</th>
                                                <th>@lang('pages/aging.detail-table.col_7')</th>
                                                <th>@lang('pages/aging.detail-table.col_8')</th>
                                                <th>@lang('pages/aging.detail-table.col_9')</th>
                                                <th>@lang('pages/aging.detail-table.col_10')</th>
                                                <th>@lang('pages/aging.detail-table.col_11')</th>
                                                <th>@lang('pages/aging.detail-table.col_12')</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->tanggal }}</td>
                                                        <td>{{ $item->kode_po }}</td>
                                                        <td>{{ $item->do->kode_do }}</td>
                                                        <td>{{ $item->pembeli->nama_usaha }} <br>
                                                            ({{ $item->pembeli->nama_depan }} {{ $item->pembeli->nama_belakang }}
                                                            )
                                                        </td>
                                                        <td>{{ $item->pemasok->nama_perusahaan }} <br>
                                                            ({{ $item->pemasok->nama_pic }})
                                                        </td>
                                                        <td>{{ $item->tipe_pembayaran->nama }}</td>
                                                        <td>{{ $item->po_detail->lama_pinjaman }} hari</td>
                                                        <td class="text-right">
                                                            Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                                        <td class="text-right";>Rp{{ number_format($item->biaya_layanan),2,".","," }}</td>
                                                        <td class="text-right";>Rp{{ number_format($item->biaya_bunga),2,".","," }}</td>
                                                        <td class="text-right";>Rp{{ number_format($item->total),2,".","," }}</td>
                                                        <td><a target="_blank" href="{{ $item->do->foto_bukti_pengiriman }}"><img src="{{ $item->do->foto_bukti_pengiriman }}" width="100" alt=""></a></td>

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
                </div>
            </div>
        </div>
    </div>
@endsection
