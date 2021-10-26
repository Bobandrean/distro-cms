@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/available-credit-line.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span class="badge badge-secondary">{{ number_format($items->count()) }}</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-light">
                                                <tr class="text-center">
                                                    <th>@lang('pages/available-credit-line.table.col_1')</th>
                                                    <th>@lang('pages/available-credit-line.table.col_2')</th>
                                                    <th>@lang('pages/available-credit-line.table.col_3')</th>
                                                    <th>@lang('pages/available-credit-line.table.col_4')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->nama }}</td>
                                                        <td class="text-center"><a href="{{ route('available-credit-line.view', $item->id) }}" target="_blank">{{ number_format($item->total_customer) }}</a></td>
                                                        <td class="text-right">Rp{{ number_format($item->total_plafon_kredit, 2, '.', ',') }}</td>
                                                        <td class="text-right">Rp{{ number_format($item->total_sisa_plafon, 2, '.', ',') }}</td>
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
