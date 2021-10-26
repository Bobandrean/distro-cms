@extends('layout')

@section('content')
    <style>
        .card {
            border: 1px solid #dddddd !important;
        }
    </style>
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/dashboard.title')
            </h1>
            <p class="header-subtitle">@lang('pages/dashboard.subtitle')</p>
            <form class="form-inline" action="" method="GET" enctype="multipart/form-data">
                <div class="form-group">
                    <select name="year" class="form-control form-control-sm">
                        <option value="">@lang('global.all_selectbox_txt')</option>
                        @for($i = 0; $i <= \Carbon\Carbon::now()->format('Y') - 2019; $i++)
                            <option value="{{ \Carbon\Carbon::now()->format('Y') - $i }}"
                                    @if($request->year == \Carbon\Carbon::now()->format('Y') - $i) selected @endif>
                                {{ \Carbon\Carbon::now()->format('Y') - $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-warning ml-2"><i
                            class="fas fa-fw fa-search"></i> @lang('global.filter_button_txt')</button>
                    <a href="{{ route('dashboard.index') }}" class="btn btn-sm btn-danger ml-2"><i
                            class="fas fa-fw fa-times"></i> @lang('global.reset_button_txt')
                    </a>
                </div>
            </form>
        </div>

        @if (session()->get('user')->tipe_akun->slug == 'super_admin' || session()->get('user')->tipe_akun->slug == 'cso' || session()->get('user')->tipe_akun->slug == 'kreditpro' )
            <div class="col-md-12">
                @if(session()->get('payment_id') != '0')
                @include('components.widgets.poduedates')
                @endif
                @include('components.widgets.calendar')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'super_admin')
            <div class="row">
                @include('components.widgets.gtv')
                @include('components.widgets.principals')
                @include('components.widgets.distributors')
                @include('components.widgets.active-principals')
                @include('components.widgets.active-distributors')
                @include('components.widgets.orders')
                @include('components.widgets.financed')
                @include('components.widgets.loan-repaid')
                @include('components.widgets.outstanding')
                @include('components.widgets.ongoing-transaction')
                @include('components.widgets.available-credit-line')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'cso')
            <div class="row">
                @include('components.widgets.gtv-cso')
                @include('components.widgets.gtv-this-month-cso')
                @include('components.widgets.active-principals')
                @include('components.widgets.active-distributors')
                @include('components.widgets.new-orders')
                @include('components.widgets.ongoing-transaction')
                @include('components.widgets.undisbursement')
                @include('components.widgets.disbursement')
                @include('components.widgets.outstanding')
                @include('components.widgets.loan-repaid')
                @include('components.widgets.available-credit-line')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'acquisition')
            <div class="row">
                @include('components.widgets.principals')
                @include('components.widgets.distributors')
                @include('components.widgets.active-principals')
                @include('components.widgets.active-distributors')
                @include('components.widgets.available-credit-line')
                @include('components.widgets.number-of-orders')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'super_admin' || session()->get('user')->tipe_akun->slug == 'acquisition' || session()->get('user')->tipe_akun->slug == 'pemasok' || session()->get('user')->tipe_akun->slug == 'gudang' || session()->get('user')->tipe_akun->slug == 'pengiriman')
            <div class="row">
                @include('components.widgets.top-product-categories')
                @include('components.widgets.top-products')
                @include('components.widgets.top-customers')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'pembeli')
            <div class="row">
                @include('components.widgets.top-product-categories')
                @include('components.widgets.top-products')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'finance')
            <div class="row">
                @include('components.widgets.gtv-cso')
                @include('components.widgets.gtv-this-month-cso')
                @include('components.widgets.active-principals')
                @include('components.widgets.active-distributors')
                @include('components.widgets.new-orders')
                @include('components.widgets.ongoing-transaction')
                @include('components.widgets.undisbursement')
                @include('components.widgets.disbursement')
                @include('components.widgets.outstanding')
                @include('components.widgets.loan-repaid')
                @include('components.widgets.available-credit-line')
            </div>
        @endif

        @if (session()->get('user')->tipe_akun->slug == 'kreditpro')
        <div class="row">
            @include('components.widgets.outstanding')
            @include('components.widgets.disbursement')
            @include('components.widgets.ongoing-transaction')
            @include('components.widgets.totaloverdue')
            @include('components.widgets.total-borrower')
        </div>
    @endif
    </div>
@endsection
