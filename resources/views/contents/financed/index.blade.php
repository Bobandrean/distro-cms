@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/financed.title')
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
                                                <tr class="text-center">
                                                    <th>@lang('pages/financed.table.col_2')</th>
                                                    <th>@lang('pages/financed.table.col_4')</th>
                                                    <th>@lang('pages/financed.table.col_5')</th>
                                                    <th>@lang('pages/financed.table.col_6')</th>
                                                    <th>@lang('pages/financed.table.col_7')</th>
                                                    <th>@lang('pages/financed.table.col_8')</th>
                                                    <th>@lang('pages/financed.table.col_9')</th>
                                                    <th>@lang('pages/financed.table.col_10')</th>
                                                    <th>@lang('pages/financed.table.col_11')</th>
                                                    <th>@lang('pages/financed.table.col_1')</th>
                                                    <th>@lang('pages/financed.table.col_12')</th>

                                                </tr>
                                                <tr>
                                                    <th>
                                                        <div class="input-group">
                                                            <input type="date" class="form-control form-control-sm" name="from" @if(isset($request->from) && !empty($request->from)) value="{{ $request->from }}" @endif>
                                                            <input type="date" class="form-control form-control-sm" name="to" @if(isset($request->to) && !empty($request->to)) value="{{ $request->to }}" @endif>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm" name="po_number" @if(isset($request->po_number) && !empty($request->po_number)) value="{{ $request->po_number }}" @endif>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm" name="do_number" @if(isset($request->do_number) && !empty($request->do_number)) value="{{ $request->do_number }}" @endif>
                                                    </th>
                                                    <th>
                                                        <select name="supplier" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}" @if(isset($request->supplier) && $request->supplier == $supplier->id) selected @endif>{{ $supplier->nama_perusahaan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="customer" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($customers as $customer)
                                                                <option value="{{ $customer->id }}" @if(isset($request->customer) && $request->customer == $customer->id) selected @endif>{{ $customer->nama_usaha }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select name="payment_type" class="form-control form-control-sm">
                                                            <option value="">@lang('global.all_selectbox_txt')</option>
                                                            @foreach($paymentTypes as $paymentType)
                                                                <option value="{{ $paymentType->id }}" @if(isset($request->payment_type) && $request->payment_type == $paymentType->id) selected @endif>{{ $paymentType->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th colspan="5">
                                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                                                        <a href="{{ route('financed.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')</a>
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
                                                        <td>{{ $item->kode_po }}</td>
                                                        <td>{{ $item->pembeli->nama_usaha }} </td>
                                                        <td>{{ $item->pemasok->nama_perusahaan }} </td>
                                                        <td>{{ $item->tipe_pembayaran->nama }}</td>
                                                        <td>{{ $item->po_detail->lama_pinjaman }} hari</td>
                                                        <td>Rp{{ number_format($item->subtotal, 2, '.', ',') }}</td>
                                                        <td>Rp{{ number_format($item->biaya_layanan, 2, '.', ',') }}</td>
                                                        <td>Rp{{ number_format($item->biaya_bunga, 2, '.', ',') }}</td>
                                                        <td>Rp{{ number_format($item->total, 2, '.', ',') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->po_detail->tanggal_pencairan)->format('Y-m-d') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->po_detail->tanggal_pelunasan)->format('Y-m-d') }}</td>
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
