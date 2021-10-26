@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/new-customer.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <br/>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span
                                        class="badge badge-secondary">{{ number_format($items->total()) }}</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>@lang('pages/new-customer.table.col_1')</th>
                                                <th>@lang('pages/new-customer.table.col_2')</th>
                                                <th>@lang('pages/new-customer.table.col_3')</th>
                                                <th>@lang('pages/new-customer.table.col_4')</th>
                                                <th>@lang('pages/new-customer.table.col_5')</th>
                                                <th>@lang('pages/new-customer.table.col_6')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($items as $item)
                                                <tr>
                                                    <td>{{ $item->nama_usaha }}</td>
                                                    <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                                    <td>{{ $item->msisdn }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>
                                                        <a href="{{ route('new-customer.accept', $item->id_user) }}" class="btn btn-sm btn-secondary" style="border-color: green;background: green;">

                                                            <i class="fas fa-fw fa-check"></i>
                                                            @lang('global.accept_button_txt')

                                                        </a>

                                                        <a href="{{ route('new-customer.reject', $item->id_user) }}" onclick="return confirm('Apakah Anda yakin akan menolak Pembeli ini?');" class="btn btn-sm btn-danger">

                                                            <i class="fas fa-fw fa-times"></i>
                                                            @lang('global.reject_button_txt')

                                                        </a>
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
