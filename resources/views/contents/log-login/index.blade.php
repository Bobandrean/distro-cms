@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/log-login.title')
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
                                                <th>@lang('pages/log-login.table.col_1')</th>
                                                <th>@lang('pages/log-login.table.col_2')</th>
                                                <th>@lang('pages/log-login.table.col_3')</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="input-group">
                                                        <input type="date" class="form-control form-control-sm" name="from" @if(isset($request->from) && !empty($request->from)) value="{{ $request->from }}" @endif>
                                                        <input type="date" class="form-control form-control-sm" name="to" @if(isset($request->to) && !empty($request->to)) value="{{ $request->to }}" @endif>
                                                    </div>
                                                </th>
                                                <th>
                                                    <input type="text" class="form-control form-control-sm" name="username" @if(isset($request->username) && !empty($request->username)) value="{{ $request->username }}" @endif>
                                                </th>
                                                <th>
                                                    <select name="role" class="form-control form-control-sm">
                                                        <option value="">@lang('global.all_selectbox_txt')</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}" @if(isset($request->role) && $request->role == $role->id) selected @endif>{{ $role->nama }}</option>
                                                        @endforeach
                                                    </select>

                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                                                    <a href="{{ route('log-login.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')</a>
                                                    <button type="submit" class="btn btn-sm btn-warning" name="export" value="1"><i class="fas fa-fw fa-file-upload"></i> @lang('global.export_button_txt')</button>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->created_at }}</td>
                                                        <td>{{ $item->users->username }}</td>
                                                        <td>{{ $item->tipe_akun->nama }}</td>
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
