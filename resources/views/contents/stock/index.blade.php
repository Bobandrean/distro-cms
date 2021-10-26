@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/stock.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->get('permissions') && in_array('stock', session()->get('permissions')['create']))
                            <a href="{{ route('stock.create') }}" class="btn btn-sm btn-primary mb-3">
                                <i class="fas fa-fw fa-plus"></i> @lang('global.create_button_txt')
                            </a>
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
                                                    <th>@lang('pages/stock.table.col_1')</th>
                                                    <th>@lang('pages/stock.table.col_2')</th>
                                                    <th>@lang('pages/stock.table.col_3')</th>
                                                    <th>@lang('pages/stock.table.col_4')</th>
                                                    <th>@lang('pages/stock.table.col_5')</th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <select name="warehouse"
                                                                class="form-control form-control-sm">
                                                            <option
                                                                value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($warehouses as $warehouse)
                                                                <option value="{{ $warehouse->id }}"
                                                                        @if(isset($request->warehouse) && $request->warehouse == $warehouse->id) selected @endif>
                                                                    {{ $warehouse->nama_gudang }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="product"
                                                                class="form-control form-control-sm">
                                                            <option
                                                                value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($products as $product)
                                                                <option value="{{ $product->id }}"
                                                                        @if(isset($request->product) && $request->product == $product->id) selected @endif>
                                                                    {{ $product->kode }} - {{ $product->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                                        </button>
                                                        <a href="{{ route('stock.index') }}"
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
                                                        <td>{{ $item->gudang->nama_gudang }}</td>
                                                        <td>{{ $item->produk->kode }} - {{ $item->produk->nama }}</td>
                                                        <td>{{ number_format($item->stok_minimum) }}</td>
                                                        <td @if($item->jumlah_stok < $item->stok_minimum) class="text-danger" @elseif($item->jumlah_stok == $item->stok_minimum) class="text-warning" @elseif($item->jumlah_stok > $item->stok_minimum) class="text-success" @endif>
                                                            {{ number_format($item->jumlah_stok) }}
                                                        </td>
                                                        <td>
                                                            @if(session()->get('permissions') && in_array('stock', session()->get('permissions')['edit']))
                                                                <a href="{{ route('stock.edit', $item->id) }}"
                                                                   class="btn btn-sm btn-secondary"><i
                                                                        class="fas fa-fw fa-edit"></i> @lang('global.update_button_txt')
                                                                </a>
                                                            @endif

                                                            @if(session()->get('permissions') && in_array('stock', session()->get('permissions')['destroy']))
                                                                <a onclick="return confirm('@lang('global.confirmation_message')');"
                                                                   href="{{ route('stock.destroy', $item->id) }}"
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
