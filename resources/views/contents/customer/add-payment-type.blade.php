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
                            <form action="{{ route('customer.store-payment-type', $request->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <br />
                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form_payment.payment_label')</label>
                                    
                                    <select name="payment_type">
                                        @foreach($payment_type as $payment)
                                            <option value="{{ $payment->id }}">{{ $payment->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form_payment.credits_label')</label>
                                    
                                    <input type="text" class="form-control form-control-sm credits" onchange="calc()" name="credits">
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
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-save"></i> @lang('global.add_button_txt')
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

        var index = 0;
        var index2 = 0;

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
