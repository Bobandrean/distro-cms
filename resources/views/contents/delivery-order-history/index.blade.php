@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/delivery-order-history.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="my-3">
                            <div class="table-responsive">
                                <form action="" method="GET" enctype="multipart/form-data">
                                    <table class="table table-bordered table-striped">
                                        <caption>{{ $items->withQueryString()->links() }}</caption>

                                        <thead class="thead-light">
                                        <tr>
                                            <th>@lang('pages/delivery-order-history.table.col_1')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_2')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_3')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_4')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_5')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_6')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_7')</th>
                                            <th>@lang('pages/delivery-order-history.table.col_8')</th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <div class="input-group">
                                                    <input type="date" class="form-control form-control-sm" name="from"
                                                           @if(isset($request->from) && !empty($request->from)) value="{{ $request->from }}" @endif>
                                                    <input type="date" class="form-control form-control-sm" name="to"
                                                           @if(isset($request->to) && !empty($request->to)) value="{{ $request->to }}" @endif>
                                                </div>
                                            </th>

                                            <th>
                                                <input type="text" class="form-control form-control-sm"
                                                       name="do_number"
                                                       @if(isset($request->do_number) && !empty($request->do_number)) value="{{ $request->do_number }}" @endif>
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

                                            <th></th>

                                            <th></th>

                                            <th></th>

                                            <th>
                                                <button type="submit" class="btn btn-sm btn-primary"><i
                                                        class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')
                                                </button>
                                                <a href="{{ route('delivery-order-history.index') }}"
                                                   class="btn btn-sm btn-danger"><i
                                                        class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')
                                                </a>
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
                                                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                                                <td><a href="{{ route('delivery-order.view', $item->id) }}"
                                                       target="_blank">{{ $item->kode_do }}</a></td>
                                                <td><a href="{{ route('purchase-order.view', $item->po->id) }}"
                                                       target="_blank">{{ $item->po->kode_po }}</a></td>
                                                <td>{{ $item->po->pembeli->nama_usaha }} <br>
                                                    ({{ $item->po->pembeli->nama_depan }} {{ $item->po->pembeli->nama_belakang }}
                                                    )
                                                </td>
                                                @if($item->status_do == 'Selesai')
                                                    <td class="text-success">{{$item->status_do}}</td>
                                                @else
                                                    <td class="text-warning">{{$item->status_do}}</td>
                                                @endif
                                                @if($item->foto_bukti_pengiriman == NULL)
                                                    <td class="text-danger">-</td>
                                                @else
                                                    <td><a href="{{ $item->foto_bukti_pengiriman}}" target="_blank">Lihat
                                                            Berkas</a></td>
                                                @endif
                                                @if($item->foto_invoice == NULL)
                                                    <td class="text-danger">-</td>
                                                @else
                                                    <td><a href="{{ $item->foto_invoice}}" target="_blank">Lihat
                                                            Berkas</a></td>
                                                @endif
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
@endsection
