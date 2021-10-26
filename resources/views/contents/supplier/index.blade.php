@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/supplier.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    @if(session()->get('permissions') && in_array('supplier', session()->get('permissions')['create']))
                        <a href="{{ route('supplier.create') }}" class="btn btn-sm btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> @lang('global.create_button_txt')</a>
                    @endif
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span class="badge badge-secondary">{{ number_format($items->total()) }}</span></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="true">@lang('global.tab_trash_txt') <span class="badge badge-secondary">{{ number_format($trashedItems->total()) }}</span></a>
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
                                                <th>@lang('pages/supplier.table.col_1')</th>
                                                <th>@lang('pages/supplier.table.col_2')</th>
                                                <th>@lang('pages/supplier.table.col_3')</th>
                                                <th>@lang('pages/supplier.table.col_4')</th>
                                                <th>@lang('pages/supplier.table.col_5')</th>
                                                <th>@lang('pages/supplier.table.col_6')</th>
                                                <th>@lang('pages/supplier.table.col_7')</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <input type="text" class="form-control form-control-sm"
                                                    name="username"
                                                    @if(isset($request->username) && !empty($request->username)) value="{{ $request->username }}" @endif>
                                                </th>

                                                <th>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="company_name"
                                                           @if(isset($request->company_name) && !empty($request->company_name)) value="{{ $request->company_name }}" @endif>
                                                </th>

                                                <th>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="pic_name"
                                                           @if(isset($request->pic_name) && !empty($request->pic_name)) value="{{ $request->pic_name }}" @endif>
                                                </th>

                                                <th>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="email"
                                                           @if(isset($request->email) && !empty($request->email)) value="{{ $request->email }}" @endif>
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
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> @lang('global.filter_button_txt')</button>
                                                    <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> @lang('global.reset_button_txt')</a>
                                                    <button type="submit" class="btn btn-sm btn-warning" name="export"
                                                    value="1"><i
                                                    class="fas fa-fw fa-file-upload"></i> @lang('global.export_button_txt')
                                                    </button>
                                                </th>


                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->users->username }}</td>
                                                        <td>{{ $item->nama_perusahaan }}</td>
                                                        <td>{{ $item->nama_pic }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->province->nama }}</td>
                                                        <td>{{ $item->regency->nama }}</td>

                                                        <td>
                                                            @if(session()->get('permissions') && in_array('supplier', session()->get('permissions')['edit']))
                                                            <a href="{{ route('supplier.edit', $item->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-edit"></i> @lang('global.update_button_txt')</a>
                                                            @endif
                                                            @if(session()->get('permissions') && in_array('supplier', session()->get('permissions')['destroy']))
                                                            <a href="{{ route('supplier.destroy', $item->id) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i> @lang('global.delete_button_txt')</a>
                                                            @endif
                                                                <a href="{{ route('supplier.distributors', $item->id) }}" target="_blank" class="btn btn-sm btn-warning"><i class="fas fa-fw fa-link"></i> @lang('pages/supplier.index.distributors_button_txt')</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade show" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                                <caption>{{ $trashedItems->withQueryString()->links() }}</caption>
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('pages/supplier.table.col_1')</th>
                                                    <th>@lang('pages/supplier.table.col_2')</th>
                                                    <th>@lang('pages/supplier.table.col_3')</th>
                                                    <th>@lang('pages/supplier.table.col_4')</th>
                                                    <th>@lang('pages/supplier.table.col_5')</th>
                                                    <th>@lang('pages/supplier.table.col_6')</th>
                                                    <th>@lang('pages/supplier.table.col_7')</th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="username"
                                                               @if(isset($request->username) && !empty($request->username)) value="{{ $request->username }}" @endif>
                                                    </th>

                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_name"
                                                               @if(isset($request->company_name) && !empty($request->company_name)) value="{{ $request->company_name }}" @endif>
                                                    </th>

                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="pic_name"
                                                               @if(isset($request->pic_name) && !empty($request->pic_name)) value="{{ $request->pic_name }}" @endif>
                                                    </th>

                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="email"
                                                               @if(isset($request->email) && !empty($request->email)) value="{{ $request->email }}" @endif>
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
                                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> @lang('global.filter_button_txt')</button>
                                                        <a href="{{ route('supplier.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> @lang('global.reset_button_txt')</a>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trashedItems as $trashedItem)
                                                    <tr>
                                                        <td>{{ $trashedItem->users->username }}</td>
                                                        <td>{{ $trashedItem->nama_perusahaan }}</td>
                                                        <td>{{ $trashedItem->nama_pic }}</td>
                                                        <td>{{ $trashedItem->email }}</td>
                                                        <td>{{ $trashedItem->province->nama }}</td>
                                                        <td>{{ $trashedItem->regency->nama }}</td>
                                                        <td>
                                                            @if(session()->get('permissions') && in_array('supplier', session()->get('permissions')['destroy']))
                                                                <a href="{{ route('supplier.restore', $trashedItem->id) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-sync"></i> @lang('global.restore_button_txt')</a>
                                                            @endif
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
