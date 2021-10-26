@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/price-catalogue.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('price-catalogue.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">@lang('pages/price-catalogue.form.buyer_type_label')</label>
                                <select name="buyer_type" class="form-control form-control-sm" disabled>
                                    <option value="">@lang('global.choose_selectbox_txt')</option>
                                    @foreach($buyerTypes as $buyerType)
                                        <option value="{{ $buyerType->id }}" @if($item->id_tipe_pembeli == $buyerType->id) selected @endif>{{ $buyerType->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('pages/price-catalogue.form.product_label')</label>
                                <select name="product" class="form-control form-control-sm" disabled>
                                    <option value="">@lang('global.choose_selectbox_txt')</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" @if($item->id_produk == $product->id) selected @endif>
                                            {{ $product->kode }} - {{ $product->nama }} - Rp{{ number_format($product->harga, 2, '.', ',') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('pages/price-catalogue.form.selling_price_label')</label>
                                <input type="text" name="selling_price" class="form-control form-control-sm selling-price" value="{{ number_format($item->harga_jual, 2, '.', ',') }}" onchange="calc()">
                            </div>
                            <div class="form-group">
                                <label for="">@lang('pages/price-catalogue.form.het_label')</label>
                                <input type="text" name="het" class="form-control form-control-sm het" value="{{ number_format($item->het, 2, '.', ',') }}" onchange="calc()">
                            </div>

                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
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
            var sellingPrice = $('.selling-price').val().replaceAll(',', '');
            var het = $('.het').val().replaceAll(',', '');

            $('.selling-price').val(currencyFormat(sellingPrice));
            $('.het').val(currencyFormat(het));
        }
    </script>
@endsection
