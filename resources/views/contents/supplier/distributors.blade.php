@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/supplier.distributors.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span class="badge badge-secondary">{{ number_format($items->total()) }}</span></a>
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
                                                    <th>@lang('pages/supplier.distributors.table.col_1')</th>
                                                    <th>@lang('pages/supplier.distributors.table.col_2')</th>
                                                    <th>@lang('pages/supplier.distributors.table.col_3')</th>
                                                    <th>@lang('pages/supplier.distributors.table.col_4')</th>
                                                    <th>@lang('pages/supplier.distributors.table.col_5')</th>
                                                    <th>@lang('pages/supplier.distributors.table.col_6')</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>
                                                        <select name="distributor" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($distributors as $distributor)
                                                                <option value="{{ $distributor->id }}"
                                                                        @if(isset($request->distributor) && $request->distributor == $distributor->id) selected @endif>{{ $distributor->nama_usaha }} ({{ $distributor->nama_depan }} {{ $distributor->nama_belakang }})</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="buyer_type" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($buyerTypes as $buyerType)
                                                                <option value="{{ $buyerType->id }}"
                                                                        @if(isset($request->buyer_type) && $request->buyer_type == $buyerType->id) selected @endif>{{ $buyerType->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="province" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}"
                                                                        @if(isset($request->province) && $request->province == $province->id) selected @endif>{{ $province->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="regency" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($regencies as $regency)
                                                                <option value="{{ $regency->id }}"
                                                                        @if(isset($request->regency) && $request->regency == $regency->id) selected @endif>{{ $regency->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                                                        <a href="{{ route('supplier.distributors', $id) }}" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')</a>
                                                        <button type="submit" class="btn btn-sm btn-warning" name="export" value="1"><i class="fas fa-fw fa-file-upload"></i> @lang('global.export_button_txt')</button>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->pemasok->nama_perusahaan }}</td>
                                                        <td>
                                                            {{ $item->pembeli->nama_usaha }} <br>
                                                            ({{ $item->pembeli->nama_depan }} {{ $item->pembeli->nama_belakang }})
                                                        </td>
                                                        <td>{{ $item->tipe_pembeli->nama }}</td>
                                                        <td>{{ $item->pembeli->province->nama }}</td>
                                                        <td>{{ $item->pembeli->regency->nama }}</td>
                                                        <td></td>
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
