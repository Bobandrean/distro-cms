@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/product-category.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    @if(session()->get('permissions') && in_array('product_category', session()->get('permissions')['create']))
                        <a href="{{ route('product-category.create') }}" class="btn btn-sm btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> @lang('global.create_button_txt')
                        </a>
                        @endif

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab"
                                   aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span
                                        class="badge badge-secondary">{{ number_format($items->total()) }}</span></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2"
                                   aria-selected="true">@lang('global.tab_trash_txt') <span
                                        class="badge badge-secondary">{{ number_format($trashedItems->total()) }}</span></a>
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
                                                <th>@lang('pages/product-category.table.col_1')</th>
                                                <th>@lang('pages/product-category.table.col_2')</th>
                                                <th>@lang('pages/product-category.table.col_3')</th>
                                                <th>@lang('pages/product-category.table.col_4')</th>
                                                </tr>
                                                <tr>
                                                <th>
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="name"
                                                           @if(isset($request->name) && !empty($request->name)) value="{{ $request->name }}" @endif>
                                                </th>

                                                <th>
                                                </th>

                                                <th>

                                                </th>
                                                <th>
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                                                    <a href="{{ route('product-category.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')</a>
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
                                                            <td>{{ $item->nama }}</td>
                                                            <td>{{ strip_tags($item->deskripsi) }}</td>
                                                            <td><img src="{{$item->ikon}}" width="150" alt="Logo"></td>
                                                            <td>
                                                                @if(session()->get('permissions') && in_array('product_category', session()->get('permissions')['edit']))
                                                                <a href="{{ route('product-category.edit', $item->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-edit"></i> @lang('global.update_button_txt')</a>
                                                                @endif
                                                                @if(session()->get('permissions') && in_array('product_category', session()->get('permissions')['destroy']))
                                                                <a href="{{ route('product-category.destroy', $item->id) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-trash"></i> @lang('global.delete_button_txt')</a>
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

                            <div class="tab-pane fade show" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                                <caption>{{ $trashedItems->withQueryString()->links() }}</caption>
                                                <thead class="thead-light">
                                                <tr>
                                                <th>@lang('pages/product-category.table.col_1')</th>
                                                <th>@lang('pages/product-category.table.col_2')</th>
                                                <th>@lang('pages/product-category.table.col_3')</th>
                                                <th>@lang('pages/product-category.table.col_4')</th>
                                                </tr>
                                                <tr>
                                                <th>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm"
                                                        name="name"
                                                        @if(isset($request->name) && !empty($request->name)) value="{{ $request->name }}" @endif>
                                                    </div>
                                                </th>

                                                <th>
                                                </th>

                                                <th>

                                                </th>
                                                <th>
                                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                                                    <a href="{{ route('product-category.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')</a>
                                                </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trashedItems as $trashedItem)
                                                    <tr>
                                                        <td>{{ $trashedItem->nama }}</td>
                                                        <td>{{ strip_tags($trashedItem->deskripsi) }}</td>
                                                        <td><img src="{{ $trashedItem->ikon }}" width="150" alt="Logo"></td>
                                                        <td>
                                                            @if(session()->get('permissions') && in_array('product_category', session()->get('permissions')['destroy']))
                                                                <a href="{{ route('product-category.restore', $trashedItem->id) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-secondary"><i class="fas fa-fw fa-sync"></i> @lang('global.restore_button_txt')</a>
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

