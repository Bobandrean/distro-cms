@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/customer.title_relations')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <br />
                        <div class="my-3">
                            <ul>
                                <li> @lang('pages/customer.form_relation.owner_label') : 
                                    {{ $items->nama_depan }} 
                                    {{ $items->nama_belakang }} 
                                </li>
                                <li> @lang('pages/customer.form_relation.business_label') : {{ $items->nama_usaha }} </li>
                                <li> @lang('pages/customer.form_relation.phone_label') : {{ $items->msisdn }} </li>
                                <li> @lang('pages/customer.form_relation.email_label') : {{ $items->email }} </li>
                                <li> @lang('pages/customer.form_relation.address_label') : {{ $items->address }} </li>
                            </ul>
                        </div>
                        <br />
                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['create']))
                            <form action="{{ route('customer.add-relation', $request->id) }}" method="GET" enctype="multipart/form-data">
                                <select class="form-control form-control-sm" name="supplier">
                                    <option value="" selected disabled>
                                        @lang('pages/customer.supplier_selectbox_txt')
                                    </option>
                                    @foreach($supplier as $supp)
                                        <option value="{{ $supp->id }}">{{ $supp->nama_perusahaan }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-plus"></i> @lang('global.add_button_txt')
                                </button>
                            </form><br />
                        @endif
                        <br /><br />
                        <div class="table-responsive">
                            <form action="" method="GET" enctype="multipart/form-data">
                                <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('pages/customer.table_relation.col_1')</th>
                                        <th>@lang('pages/customer.table_relation.col_2')</th>
                                        <th width="200px">@lang('pages/customer.table_relation.col_3')</th>
                                        <th width="200px">@lang('pages/customer.table_relation.col_4')</th>
                                        <th width="150px">@lang('pages/customer.table_relation.col_5')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items->relasi_pembeli_pemasok as $relasi)
                                    <tr>
                                        <td> {{ $relasi->pemasok->nama_perusahaan}} </td>
                                        <td> {{ $relasi->pemasok->nama_pic}} </td>
                                        <td> {{ $relasi->pemasok->email}} </td>
                                        <td> {{ $relasi->pemasok->alamat}} </td>
                                        <td> 
                                            @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['destroy']))
                                                <a href="{{ route('customer.destroy-relation', $relasi->id) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-danger"><i class="fas fa-fw fa-times"></i> @lang('pages/customer.index.delete_supplier_button_txt')</a>
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
@endsection
