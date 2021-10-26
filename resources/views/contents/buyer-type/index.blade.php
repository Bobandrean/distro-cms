@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/buyer-type.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->get('permissions') && in_array('buyer_type', session()->get('permissions')['create']))
                            <a href="{{ route('buyer-type.create') }}" class="btn btn-sm btn-primary mb-3"><i
                                    class="fas fa-fw fa-plus"></i> @lang('global.create_button_txt')</a>
                        @endif
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
                                                    @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                        <th>@lang('pages/buyer-type.table.col_1')</th>
                                                    @endif
                                                    <th>@lang('pages/buyer-type.table.col_2')</th>
                                                    <th>@lang('pages/buyer-type.table.col_3')</th>
                                                    <th>@lang('pages/buyer-type.table.col_4')</th>
                                                </tr>
                                                <tr>
                                                    @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                        <th>
                                                            <select name="supplier"
                                                                    class="form-control form-control-sm">
                                                                <option
                                                                    value="">@lang('global.all_selectbox_txt')</option>
                                                                @foreach($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                            @if(isset($request->supplier) && $request->supplier == $supplier->id) selected @endif>{{ $supplier->nama_perusahaan }}
                                                                        ({{ $supplier->nama_pic }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </th>
                                                    @endif

                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="name"
                                                               @if(isset($request->name) && !empty($request->name)) value="{{ $request->name }}" @endif>
                                                    </th>

                                                    <th></th>

                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                                        </button>
                                                        <a href="{{ route('buyer-type.index') }}"
                                                           class="btn btn-sm btn-danger"><i
                                                                class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')
                                                        </a>
                                                        <button type="submit" class="btn btn-sm btn-warning"
                                                                name="export"
                                                                value="1"><i
                                                                class="fas fa-fw fa-file-upload"></i> @lang('global.export_button_txt')
                                                        </button>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($items as $item)
                                                    <tr>
                                                        @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                            <td>
                                                                {{ $item->pemasok->nama_perusahaan }} <br>
                                                                ({{ $item->pemasok->nama_pic }})
                                                            </td>
                                                        @endif
                                                        <td>{{ $item->nama }}</td>
                                                        <td>{{ strip_tags($item->keterangan)}}</td>
                                                        <td>
                                                            @if(session()->get('permissions') && in_array('buyer_type', session()->get('permissions')['edit']))
                                                                <a href="{{ route('buyer-type.edit', $item->id) }}"
                                                                   class="btn btn-sm btn-secondary"><i
                                                                        class="fas fa-fw fa-edit"></i> @lang('global.update_button_txt')
                                                                </a>
                                                            @endif
                                                            @if(session()->get('permissions') && in_array('buyer_type', session()->get('permissions')['destroy']))
                                                                <a href="{{ route('buyer-type.destroy', $item->id) }}"
                                                                   onclick="return confirm('@lang('global.confirmation_message')');"
                                                                   class="btn btn-sm btn-danger"><i
                                                                        class="fas fa-fw fa-trash"></i> @lang('global.delete_button_txt')
                                                                </a>
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
