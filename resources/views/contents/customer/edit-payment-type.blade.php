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
                        <div class="table-responsive">
                            <form action="{{ route('customer.update-payment-type', ['customer_id' => $customer_id,
                                'payment_id' => $payment_type_customer->id_pembayaran]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <br />
                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form_payment.payment_label')</label>

                                    <select name="payment_type" disabled>
                                        @foreach($payment_type as $payment)
                                            <option value="{{ $payment->id }}" @if($payment_type_customer->id_pembayaran == $payment->id) selected @endif>{{ $payment->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form_payment.credits_label')</label>

                                    <input type="text" class="form-control form-control-sm credits" onchange="calc()" name="credits" value="Rp{{ number_format($payment_type_customer->plafon_kredit, 2, '.', ',') }}" disabled>
                                </div>
                                <br />
                                <table class="table table-bordered table-striped">
                                    <caption>
                                        <button type="button" class="btn btn-sm btn-secondary add-row">
                                            <i class="fas fa-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary rm-row">
                                            <i class="fas fa-minus"></i></button>
                                    </caption>
                                    <thead class="thead-light">
                                        <tr>
                                            <th><center>@lang('pages/customer.table_add_payment.col_1')</center></th>
                                            <th><center>@lang('pages/customer.table_add_payment.col_2')</center></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                        @foreach($payment_type_day as $key => $day)
                                        <tr class="trow">
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="top[]" index="{{ $key }}" value="{{ $day->hari }}" placeholder="Hari / TOP">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="rate[]" index="{{ $key }}" value="{{ $day->rate }}" placeholder="Rate">
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered table-striped">
                                    <caption>
                                        <button type="button" class="btn btn-sm btn-secondary add-row-2"><i class="fas fa-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-secondary rm-row-2"><i class="fas fa-minus"></i></button>
                                    </caption>
                                    <thead class="thead-light">
                                        <tr>
                                            <th><center>@lang('pages/customer.table_add_payment.col_3')</center></th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-2">
                                        @foreach($payment_type_method as $key2 => $method)
                                        <tr class="trow2">
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="method[]" index="{{ $key2 }}" value="{{ $method->metode }}" placeholder="Metode">
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-save"></i> @lang('global.save_button_txt')
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('script')
    <script type="text/javascript">
        function calc() {
            var credits = $('.credits').val().replaceAll(',', '');

            $('.credits').val(currencyFormat(credits));
        }

        var index = {{ count($payment_type_day) }};
        var index2 = {{ count($payment_type_method) }};

        $('.add-row').on('click', function() {
            $('.tbody').append('<tr class="trow">'+
                '<td><div class="form-group">'+
                '<div><input type="text" class="form-control" name="top[]" index="'+index+'" value="" placeholder="Hari / TOP">'+
                '</div></div></td>'+
                '<td><div class="form-group">'+
                '<div><input type="text" class="form-control" name="rate[]"  index="'+index+'" value="" placeholder="Rate">'+
                '</div></div></td>'+
                '</tr>');

            $('select').select2({
                width: '100%'
            });

            index++;
        });

        $('.add-row-2').on('click', function() {
            $('.tbody-2').append('<tr class="trow2">'+
                '<td><div class="form-group">'+
                '<div><input type="text" class="form-control" name="method[]" index="'+index2+'" value="" placeholder="Metode">'+
                '</div></div></td>'+
                '</tr>');

            $('select-2').select2({
                width: '100%'
            });

            index2++;
        });

        $('.rm-row').on('click', function() {
            $('.trow:last').remove();
            index--;
        });

        $('.rm-row-2').on('click', function() {
            $('.trow2:last').remove();
            index2--;
        });

        $(function() {
            // Datatables basic
            $('#datatables-basic').DataTable({
                responsive: true,
                header: false,
                footer: false
            });
            // Datatables with Buttons
            var datatablesButtons = $('#datatables-buttons').DataTable({
                lengthChange: !1,
                buttons: ["copy", "print"],
                responsive: true,
                searching: false,
                paging: false,

            });

            datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
        });
    </script>
@endsection
@endsection
