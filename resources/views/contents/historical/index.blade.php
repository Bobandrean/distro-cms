@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/historical.title')
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
                                                    <th>@lang('pages/historical.table.col_1')</th>
                                                    <th>@lang('pages/historical.table.col_2')</th>
                                                    <th>@lang('pages/historical.table.col_3')</th>
                                                    <th>@lang('pages/historical.table.col_4')</th>
                                                    <th>@lang('pages/historical.table.col_5')</th>
                                                    <th>@lang('pages/historical.table.col_6')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                                                        <td><a href="{{ route('historical.view', ['customer_id' => $customer_id, 'po_id' => $item->id]) }}"
                                                               target="_blank">{{ $item->kode_po }}</a></td>
                                                        <td>{{ $item->pembeli->nama_usaha }}</td>
                                                        <td>{{ $item->pemasok->nama_perusahaan }}</td>
                                                        <td>Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                                        <td>
                                                            <b @if($item->po_detail->status_pelunasan == 'Belum Lunas') class="text-warning"
                                                               @elseif($item->po_detail->status_pelunasan == 'Lunas') class="text-success" @endif>
                                                                {{ $item->po_detail->status_pelunasan }}
                                                            </b>
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
                </div>
            </div>
        </div>
    </div>
@endsection
