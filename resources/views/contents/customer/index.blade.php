@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/customer.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['create']))
                            <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-plus"></i> @lang('global.create_button_txt')</a>
                        @endif
                        <br /><br />
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="true">@lang('global.tab_all_txt') <span
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
                                                    <th>@lang('pages/customer.table.col_1')</th>
                                                    <th>@lang('pages/customer.table.col_2')</th>
                                                    <th width="200px">@lang('pages/customer.table.col_3')</th>
                                                    <th width="200px">@lang('pages/customer.table.col_4')</th>
                                                    <th width="150px">@lang('pages/customer.table.col_5')</th>
                                                    <th width="230px">@lang('pages/customer.table.col_6')</th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                        name="nama_usaha" @if(isset($request->nama_usaha) && !empty($request->nama_usaha)) value="{{ $request->nama_usaha }}" @endif>
                                                    </th>
                                                    <th>
                                                        <input type="text" class="form-control form-control-sm"
                                                        name="nama" @if(isset($request->nama) && !empty($request->nama)) value="{{ $request->nama }}" @endif>
                                                    </th>
                                                    <th>
                                                        <select class="form-control form-control-sm" name="province">
                                                            <option value="" selected>
                                                                @lang('global.all_selectbox_txt')
                                                            </option>
                                                            @foreach($provinces as $province)
                                                                <option value="{{ $province->id }}" @if($request->province == $province->id) selected @endif>{{ $province->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <select class="form-control form-control-sm select-province" name="regency">
                                                            <option value="" selected>
                                                                @lang('global.all_selectbox_txt')
                                                            </option>
                                                            @foreach($regencies as $regency)
                                                                <option value="{{ $regency->id }}" @if($request->regency == $regency->id) selected @endif>{{ $regency->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th></th>
                                                    <th>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-search"></i> @lang('global.filter_button_txt')</button>
                                                        <a href="{{ route('customer.index') }}" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> @lang('global.reset_button_txt')</a>
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
                                                    <td>{{ $item->nama_usaha }}</td>
                                                    <td>{{ $item->nama_depan }} {{ $item->nama_belakang }}</td>
                                                    <td>{{ $item->province->nama }}</td>
                                                    <td>{{ $item->regency->nama }}</td>
                                                    <td>
                                                        <?php $plafon_kredit = 0; ?>
                                                        @foreach($item->tipe_pembayaran_pembeli as $tpb)
                                                            @if ($payment_id != '0' && $tpb->id_pembayaran == $payment_id)
                                                                <?php $plafon_kredit = $plafon_kredit + $tpb->plafon_kredit; ?>
                                                            @elseif ($payment_id == '0')
                                                                <?php $plafon_kredit = $plafon_kredit + $tpb->plafon_kredit; ?>
                                                            @endif
                                                        @endforeach

                                                        <?php echo "Rp". number_format($plafon_kredit, 2, '.', ',');?>
                                                    </td>
                                                    <td>
                                                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['edit']))
                                                        <a href="{{ route('customer.edit', $item->id) }}" class="btn btn-sm btn-secondary">
                                                            <i class="fas fa-fw fa-edit"></i>
                                                            @lang('global.update_button_txt')
                                                        </a>
                                                        <br /> <br>
                                                        @endif
                                                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['create']))
                                                        <a href="{{ route('customer.relation', $item->id) }}" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-fw fa-handshake"></i>
                                                            @lang('pages/customer.index.relation_button_txt')
                                                        </a>
                                                        <br /> <br>
                                                        @endif
                                                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['create']))
                                                        <a href="{{ route('customer.payment-type', $item->id) }}" class="btn btn-sm btn-info">
                                                            <i class="fas fa-fw fa-file-alt"></i>
                                                            @lang('pages/customer.index.payment_type_button_txt')
                                                        </a>
                                                        <br /> <br>
                                                        @endif
                                                        <a href="{{ route('document.index', $item->id) }}" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-fw fa-file"></i>
                                                            @lang('pages/customer.index.document_button_txt')
                                                        </a>
                                                        <br /> <br>
                                                        <a href="{{ route('historical.index', ['customer_id' => $item->id]) }}" class="btn btn-sm btn-dark">
                                                            <i class="fas fa-fw fa-file"></i>
                                                            @lang('pages/customer.index.historical_trx_button_txt')
                                                        </a>
                                                        <br /> <br>
                                                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['destroy']))
                                                            <a href="{{ route('customer.destroy', $item->id_user) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('pages/customer.index.delete_button_txt')</a>
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
