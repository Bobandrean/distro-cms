@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/financing.title') (Upload Invoice Principal)
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('financing-inv-princ.update', $item->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <img src="{{$item->po_detail->berkas_invoice}}" width="100">
                                <label for="">@lang('pages/financing.form-inv-princ.file_label')</label>
                                <input type="file" class="form-control form-control-sm" name="file">
                            </div>

                            <div class="form-group">
                                <label class="form-label"> @lang('pages/financing.invoice_label')</label>
                                <input type="date" class="form-control form-control-sm" name="invoice_date">
                            </div>

                            <div class="form-group">
                                <label for="cars">@lang('pages/financing.loan_label')</label>
                                <select name="loan">
                                    <option value="" selected>Select Days</option>
                                    <option value="30">30 Days</option>
                                    <option value="60">60 Days</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label
                                    class="form-label"> @lang('pages/financing.form-inv-princ.disburst_label')</label>
                                <input type="date" class="form-control form-control-sm" name="disburst_date">
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
