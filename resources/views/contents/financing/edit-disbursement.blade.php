@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/financing.title') (Edit Disbursement)
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('financing-disbursement.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label"> @lang('pages/financing.form-disbursement.date_label')</label>
                            <input type="date" class="form-control form-control-sm" name="disbursement_date">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('pages/financing.form-disbursement.interest_label')</label>
                            <input type="text" class="form-control form-control-sm interest" name="interest" value="{{ number_format($item->biaya_bunga, 2, '.', ',') }}" onchange="calc()">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('pages/financing.form-disbursement.provisi_label')</label>
                            <input type="text" class="form-control form-control-sm provisi" name="provisi" value="{{ number_format($item->biaya_provisi, 2, '.', ',') }}" onchange="calc()">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('pages/financing.form-disbursement.service_cost_label')</label>
                            <input type="text" class="form-control form-control-sm service_cost" name="service_cost" value="{{ number_format($item->biaya_layanan, 2, '.', ',') }}" onchange="calc()">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('pages/financing.form-disbursement.disbursement_value_label')</label>
                            <input type="text" class="form-control form-control-sm disbursement_value" name="disbursement_value" value="{{ number_format($item->nilai_pencairan, 2, '.', ',') }}" onchange="calc()">
                        </div>
                        <div class="form-group">
                            <label for="">@lang('pages/financing.form-repayment.repayment_value_label')</label>
                            <input type="text" class="form-control form-control-sm repayment_value" name="repayment_value" value="{{ number_format($item->nilai_pelunasan, 2, '.', ',') }}" onchange="calc()">
                        </div>
                        <div class="form-group">
                            <label
                                class="form-label"> @lang('pages/financing.form-repayment.notes_label')</label>
                            <textarea name="notes" class="form-control form-control-sm" cols="30" rows="10">{{ $item->po_detail->catatan }}</textarea>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        function calc() {
            var interest = $('.interest').val().replaceAll(',', '');
            var provisi = $('.provisi').val().replaceAll(',', '');
            var service_cost = $('.service_cost').val().replaceAll(',', '');
            var disbursement_value = $('.disbursement_value').val().replaceAll(',', '');
            var repayment_value = $('.repayment_value').val().replaceAll(',', '');

            $('.interest').val(currencyFormat(interest));
            $('.provisi').val(currencyFormat(provisi));
            $('.service_cost').val(currencyFormat(service_cost));
            $('.disbursement_value').val(currencyFormat(disbursement_value));
            $('.repayment_value').val(currencyFormat(repayment_value));
        }

    </script>
@endsection

