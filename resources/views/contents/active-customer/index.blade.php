@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
            	@lang('pages/active-customer.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_active_txt') <span class="badge badge-secondary">{{ number_format(count($getDataActiveCustomers)) }}</span></a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" data-toggle="tab" href="#tab2" role="tab" aria-controls="tab2" aria-selected="true">@lang('global.tab_inactive_txt') <span class="badge badge-secondary">{{ number_format(count($getInactiveCustomer)) }}</span></a>
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
                                                    <th>@lang('pages/active-customer.table_1.col_2')</th>
                                                    <th>@lang('pages/active-customer.table_1.col_3')</th>
                                                    <th>@lang('pages/active-customer.table_1.col_4')</th>
                                                    <th>@lang('pages/active-customer.table_1.col_5')</th>
                                                </tr>
                                                <tr>
	                                                <th></th>
	                                                <th></th>
	                                                <th></th>
                                                    <th colspan="5">
                                                    <center>
                                                        <button type="submit" class="btn btn-sm btn-warning" name="export"
                                                                value="1"><i
                                                                class="fas fa-fw fa-file-upload"></i> @lang('global.export_button_txt')
                                                        </button>
                                                    </center>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                	@foreach($items as $item)
                                                    <tr>
                                                        <td>{{ $item->pembeli->nama_usaha }} </td>
                                                        <td><center>{{ $item->jumlah_transaksi }}</center></td>
                                                        <td><center>Rp{{ number_format($item->subtotal, 2, '.', ',') }}</center></td>
                                                        <td></td>
                                                    </tr>
                                                	@endforeach
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab2" role="tabpanel" aria-labelledby="tab2">
                                <div class="my-3">
                                    <div class="table-responsive">
                                        <form action="" method="GET" enctype="multipart/form-data">
                                            <table class="table table-bordered table-striped">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>@lang('pages/active-customer.table_2.col_2')</th>
                                                    <th>@lang('pages/active-customer.table_2.col_6')</th>
                                                    <th>@lang('pages/active-customer.table_2.col_7')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                	@foreach($getInactiveCustomer as $inactive)
                                                    <tr>
                                                        <td>{{ $inactive->nama_usaha }} </td>
                                                        <td>{{ $inactive->nama_depan }} {{ $inactive->nama_belakang }} </td>
                                                        <td>{{ $inactive->msisdn }} </td>
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
