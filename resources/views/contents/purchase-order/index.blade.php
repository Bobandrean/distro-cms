@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/purchase-order.title')
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
                                                    <th width="50px">@lang('pages/purchase-order.table.col_1')</th>
                                                    <th>@lang('pages/purchase-order.table.col_2')</th>
                                                    <th>@lang('pages/purchase-order.table.col_3')</th>
                                                    <th>@lang('pages/purchase-order.table.col_4')</th>
                                                    <th width="130px">@lang('pages/purchase-order.table.col_5')</th>
                                                    <th>@lang('pages/purchase-order.table.col_6')</th>
                                                    <th>@lang('pages/purchase-order.table.col_7')</th>
                                                    <th width="100px">@lang('pages/purchase-order.table.col_8')</th>
                                                    <th>@lang('pages/purchase-order.table.col_9')</th>
                                                    <th>@lang('pages/purchase-order.table.col_10')</th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="input-group">
                                                            <input type="date" class="form-control form-control-sm"
                                                                   name="from"
                                                                   @if(isset($request->from) && !empty($request->from)) value="{{ $request->from }}" @endif>
                                                        </div>
                                                        <div class="input-group">
                                                            <input type="date" class="form-control form-control-sm"
                                                                   name="to"
                                                                   @if(isset($request->to) && !empty($request->to)) value="{{ $request->to }}" @endif>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="po_number"
                                                               @if(isset($request->po_number) && !empty($request->po_number)) value="{{ $request->po_number }}" @endif>

                                                    </th>
                                                    <th>
                                                        <select name="customer"
                                                                class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{ $customer->id }}"
                                                                        @if(isset($request->customer) && $request->customer == $customer->id) selected @endif>
                                                                    {{ $customer->nama_usaha }}
                                                                    ({{ $customer->nama_depan }} {{ $customer->nama_belakang }}
                                                                    )
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </th>

                                                    <th>
                                                        @if (session()->get('payment_id') == '0')
                                                            <select name="supplier"
                                                                    class="form-control form-control-sm">
                                                                <option
                                                                    value="">@lang('global.all_selectbox_txt')</option>
                                                                @foreach($suppliers as $supplier)
                                                                    <option value="{{ $supplier->id }}"
                                                                            @if(isset($request->supplier) && $request->supplier == $supplier->id) selected @endif>
                                                                        {{ $supplier->nama_perusahaan }}
                                                                        ({{ $supplier->nama_pic }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </th>

                                                    <th>
                                                        @if(session()->get('payment_id') == '0')
                                                            <select name="payment_type"
                                                                    class="form-control form-control-sm">
                                                                <option
                                                                    value="">@lang('global.all_selectbox_txt')</option>
                                                                @foreach($paymentTypes as $paymentType)
                                                                    <option value="{{ $paymentType->id }}"
                                                                            @if(isset($request->payment_type) && $request->payment_type == $paymentType->id) selected @endif>
                                                                        {{ $paymentType->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </th>

                                                    <th></th>

                                                    <th></th>

                                                    <th>
                                                        <select name="status" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            <option value="Menunggu"
                                                                    @if(isset($request->status) && $request->status == 'Menunggu') selected @endif>
                                                                Menunggu
                                                            </option>
                                                            <option value="Diterima_Pemasok"
                                                                    @if(isset($request->status) && $request->status == 'Diterima_Pemasok') selected @endif>
                                                                Diterima Pemasok
                                                            </option>
                                                            <option value="Diterima_Gudang"
                                                                    @if(isset($request->status) && $request->status == 'Diterima_Gudang') selected @endif>
                                                                Diterima Gudang
                                                            </option>
                                                            <option value="Dibatalkan"
                                                                    @if(isset($request->status) && $request->status == 'Dibatalkan') selected @endif>
                                                                Dibatalkan
                                                            </option>
                                                        </select>
                                                    </th>

                                                    <th>
                                                        <select name="payment_status"
                                                                class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            <option value="Belum Lunas"
                                                                    @if(isset($request->payment_status) && $request->payment_status == 'Belum Lunas') selected @endif>
                                                                Belum Lunas
                                                            </option>
                                                            <option value="Lunas"
                                                                    @if(isset($request->payment_status) && $request->payment_status == 'Lunas') selected @endif>
                                                                Lunas
                                                            </option>
                                                        </select>
                                                    </th>

                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                                        </button>
                                                        <a href="{{ route('purchase-order.index') }}"
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
                                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                                                        <td><a href="{{ route('purchase-order.view', $item->id) }}"
                                                               target="_blank">{{ $item->kode_po }}</a></td>
                                                        <td>{{ $item->pembeli->nama_usaha }}
                                                            {{--                                                            <br>--}}
                                                            {{--                                                            ({{ $item->pembeli->nama_depan }} {{ $item->pembeli->nama_belakang }} )--}}
                                                        </td>
                                                        <td>{{ $item->pemasok->nama_perusahaan }}
                                                            {{--                                                                <br>--}}
                                                            {{--                                                                ({{ $item->pemasok->nama_pic }})--}}
                                                        </td>
                                                        <td>{{ $item->tipe_pembayaran->nama }}</td>
                                                        <td>{{ $item->po_detail->lama_pinjaman }} hari</td>
                                                        <td>
                                                            Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                                        <td>
                                                            <b @if($item->status_po == 'Menunggu') class="text-dark"
                                                               @elseif($item->status_po == 'Dibatalkan') class="text-danger"
                                                               @elseif($item->status_po == 'Diterima_Pemasok') class="text-warning"
                                                               @elseif($item->status_po == 'Diterima_Gudang') class="text-success" @endif>
                                                                {{ $item->status_po }}
                                                            </b>
                                                        </td>
                                                        <td>
                                                            @if($item->po_detail->status_pelunasan == 'Belum Lunas')
                                                                <p class="text-danger">Belum Lunas</p>
                                                            @elseif($item->po_detail->status_pelunasan == 'Lunas')
                                                                <p class="text-success">Lunas</p>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            @if ($item->po_detail->status_pelunasan == 'Belum Lunas' && session('payment_id') != '0' && session()->get('payment_id') == '10')
                                                                <a target="_blank"
                                                                   @if(config('kaspro.APP_STATE') == 'prod') href="https://distro-api.grosir.one/api/pembayaran?kode_po={{ $item->kode_po }}"
                                                                   @else href="https://development-api-distro.grosir.one/api/pembayaran?kode_po={{ $item->kode_po }}"
                                                                   @endif
                                                                   class="btn btn-sm btn-secondary">
                                                                    <i class="fas fa-fw fa-credit-card"></i> Payment
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
