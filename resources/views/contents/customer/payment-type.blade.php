@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/customer.title_payment')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['create']))
                            <a href="{{ route('customer.add-payment-type', $request->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-plus"></i> @lang('global.add_button_txt')</a>
                        @endif
                        <div class="my-3">
                            <ul>
                                <li> @lang('pages/customer.form_relation.owner_label') :
                                    {{ $items->nama_depan }}
                                    {{ $items->nama_belakang }}
                                </li>
                                <li> @lang('pages/customer.form_relation.business_label') : {{ $items->nama_usaha }} </li>
                                <li> @lang('pages/customer.form_relation.phone_label') : {{ $items->msisdn }} </li>
                                <li> @lang('pages/customer.form_relation.email_label') : {{ $items->email }} </li>
                                <li> @lang('pages/customer.form_relation.address_label') : {{ strip_tags($items->alamat) }} </li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <form action="" method="GET" enctype="multipart/form-data">
                                <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>@lang('pages/customer.table_payment.col_1')</th>
                                        <th>@lang('pages/customer.table_payment.col_2')</th>
                                        <th width="200px">@lang('pages/customer.table_payment.col_3')</th>
                                        <th width="200px">@lang('pages/customer.table_payment.col_4')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items->tipe_pembayaran_pembeli as $payment)
                                    <tr>
                                        <td> {{ $payment->tipe_pembayaran->nama }} </td>
                                        <td class="text-right"> Rp{{ number_format($payment->sisa_plafon, 2, '.', ',') }} </td>
                                        <td class="text-right"> Rp{{ number_format($payment->plafon_kredit, 2, '.', ',') }} </td>
                                        <td>
                                            @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['edit']))
                                            <a href="{{ route('customer.edit-payment-type', [$request->id, $payment->id_pembayaran]) }}" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-fw fa-edit"></i>
                                            @lang('pages/customer.index.edit_payment_button_txt')</a>
                                            @endif

                                            @if(session()->get('permissions') && in_array('customer', session()->get('permissions')['destroy']))
                                            <a href="{{ route('customer.destroy-payment', [$request->id, $payment->id_pembayaran]) }}" onclick="return confirm('@lang('global.confirmation_message')');" class="btn btn-sm btn-danger">
                                            <i class="fas fa-fw fa-times"></i>
                                            @lang('pages/customer.index.delete_supplier_button_txt')</a>
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
