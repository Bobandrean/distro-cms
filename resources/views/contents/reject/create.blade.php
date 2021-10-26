@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/reject.title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('reject.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="buyer_type">@lang('pages/reject.form.buyer_type')</label>
                            <select id="select3" name="buyer">
                                @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" @if(isset($request->id) && $request->customer == $customer->id) selected @endif>{{ $customer->nama_usaha }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="buyer_type">@lang('pages/reject.form.buyer_type')</label>
                            <select id="select" name="payment_type">
                                @foreach($PaymentType as $payment)
                                <option value="{{ $payment->id }}" @if(isset($request->payment_type) && $request->payment_type == $payment->id) selected @endif>{{ $payment->nama }}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">@lang('pages/reject.form.reason')</label>
                            <input type="text" class="form-control form-control-sm" name="reason" value="{{ old('reason') }}">
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
