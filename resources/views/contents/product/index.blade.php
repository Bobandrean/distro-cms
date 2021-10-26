@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/product.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->get('permissions') && in_array('product', session()->get('permissions')['create']))
                            <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary mb-3">
                                <i class="fas fa-fw fa-plus"></i> @lang('global.create_button_txt')
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
                                                    <th>@lang('pages/product.table.col_1')</th>
                                                    @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                        <th>@lang('pages/product.table.col_2')</th>
                                                    @endif
                                                    <th>@lang('pages/product.table.col_3')</th>
                                                    <th>@lang('pages/product.table.col_4')</th>
                                                    <th>@lang('pages/product.table.col_5')</th>
                                                    <th>@lang('pages/product.table.col_6')</th>
                                                    <th>@lang('pages/product.table.col_7')</th>
                                                    <th>@lang('pages/product.table.col_8')</th>
                                                    <th>@lang('pages/product.table.col_9')</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
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
                                                        <select name="product_category"
                                                                class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($productCategories as $productCategory)
                                                                <option value="{{ $productCategory->id }}"
                                                                        @if(isset($request->product_category) && $request->product_category == $productCategory->id) selected @endif>{{ $productCategory->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="sku"
                                                               @if(isset($request->sku) && !empty($request->sku)) value="{{ $request->sku }}" @endif>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="product_name"
                                                               @if(isset($request->product_name) && !empty($request->product_name)) value="{{ $request->product_name }}" @endif>
                                                    </th>
                                                    <th>
                                                        <select name="tax" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            <option value="Ya"
                                                                    @if(isset($request->tax) && $request->tax == 'Ya') selected @endif>
                                                                Ya
                                                            </option>
                                                            <option value="Tidak"
                                                                    @if(isset($request->tax) && $request->tax == 'Tidak') selected @endif>
                                                                Tidak
                                                            </option>
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                                        </button>
                                                        <a href="{{ route('product.index') }}"
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
                                                        <td><img src="{{ $item->foto_1 }}" width="80" alt="no image">
                                                        </td>
                                                        @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                            <td>{{ $item->pemasok->nama_perusahaan }} <br>
                                                                ({{ $item->pemasok->nama_pic }})
                                                            </td>
                                                        @endif
                                                        <td>{{ $item->kategori_produk->nama }}</td>
                                                        <td>{{ $item->kode }}</td>
                                                        <td>{{ $item->nama }}</td>
                                                        <td @if($item->ppn == 'Ya') class="text-success" @elseif($item->ppn == 'Tidak') class="text-danger" @endif>{{ $item->ppn }}</td>
                                                        <td>Rp{{ number_format($item->harga_dasar, 2, '.', ',') }}</td>
                                                        <td>Rp{{ number_format($item->harga, 2, '.', ',') }}</td>
                                                        <td>
                                                            @if(session()->get('permissions') && in_array('product', session()->get('permissions')['edit']))
                                                                <a href="{{ route('product.edit', $item->id) }}"
                                                                   class="btn btn-sm btn-secondary"><i
                                                                        class="fas fa-fw fa-edit"></i> @lang('global.update_button_txt')
                                                                </a>
                                                            @endif

                                                            @if(session()->get('permissions') && in_array('product', session()->get('permissions')['destroy']))
                                                                <a onclick="return confirm('@lang('global.confirmation_message')');"
                                                                   href="{{ route('product.destroy', $item->id) }}"
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

                            <div class="tab-pane fade show" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                                <caption>{{ $trashedItems->withQueryString()->links() }}</caption>
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('pages/product.table.col_1')</th>
                                                    @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                        <th>@lang('pages/product.table.col_2')</th>
                                                    @endif
                                                    <th>@lang('pages/product.table.col_3')</th>
                                                    <th>@lang('pages/product.table.col_4')</th>
                                                    <th>@lang('pages/product.table.col_5')</th>
                                                    <th>@lang('pages/product.table.col_6')</th>
                                                    <th>@lang('pages/product.table.col_7')</th>
                                                    <th>@lang('pages/product.table.col_8')</th>
                                                    <th>@lang('pages/product.table.col_9')</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
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
                                                        <select name="product_category"
                                                                class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($productCategories as $productCategory)
                                                                <option value="{{ $productCategory->id }}"
                                                                        @if(isset($request->product_category) && $request->product_category == $productCategory->id) selected @endif>{{ $productCategory->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="sku"
                                                               @if(isset($request->sku) && !empty($request->sku)) value="{{ $request->sku }}" @endif>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="product_name"
                                                               @if(isset($request->product_name) && !empty($request->product_name)) value="{{ $request->product_name }}" @endif>
                                                    </th>
                                                    <th>
                                                        <select name="tax" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            <option value="Ya"
                                                                    @if(isset($request->tax) && $request->tax == 'Ya') selected @endif>
                                                                Ya
                                                            </option>
                                                            <option value="Tidak"
                                                                    @if(isset($request->tax) && $request->tax == 'Tidak') selected @endif>
                                                                Tidak
                                                            </option>
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                                        </button>
                                                        <a href="{{ route('product.index') }}"
                                                           class="btn btn-sm btn-danger"><i
                                                                class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')
                                                        </a>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trashedItems as $trashedItem)
                                                    <tr>
                                                        <td><img src="{{ $trashedItem->foto_1 }}" width="80"
                                                                 alt="no image"></td>
                                                        @if(session()->get('user')->tipe_akun->slug == 'super_admin')
                                                            <td>{{ $trashedItem->pemasok->nama_perusahaan }} <br>
                                                                ({{ $trashedItem->pemasok->nama_pic }})
                                                            </td>
                                                        @endif
                                                        <td>{{ $trashedItem->kategori_produk->nama }}</td>
                                                        <td>{{ $trashedItem->kode }}</td>
                                                        <td>{{ $trashedItem->nama }}</td>
                                                        <td @if($trashedItem->ppn == 'Ya') class="text-success" @elseif($trashedItem->ppn == 'Tidak') class="text-danger" @endif>{{ $trashedItem->ppn }}</td>
                                                        <td>Rp{{ number_format($trashedItem->harga_dasar, 2, '.', ',') }}</td>
                                                        <td>Rp{{ number_format($trashedItem->harga, 2, '.', ',') }}</td>
                                                        <td>
                                                            @if(session()->get('permissions') && in_array('product', session()->get('permissions')['destroy']))
                                                                <a onclick="return confirm('@lang('global.confirmation_message')');"
                                                                   href="{{ route('product.restore', $trashedItem->id) }}"
                                                                   class="btn btn-sm btn-secondary"><i
                                                                        class="fas fa-fw fa-sync"></i> @lang('global.restore_button_txt')
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
