@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/stock.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('stock.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="">@lang('pages/stock.form.product_label')</label>
                                <select name="product" class="form-control form-control-sm">
                                    <option value="">@lang('global.choose_selectbox_txt')</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">
                                            {{ $product->kode }} - {{ $product->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">@lang('pages/stock.form.stock_minimum_label')</label>
                                <input type="text" name="stock_minimum" class="form-control form-control-sm stock-minimum" value="{{ old('stock_minimum') }}" onchange="calc()">
                            </div>
                            <div class="form-group">
                                <label for="">@lang('pages/stock.form.stock_quantity_label')</label>
                                <input type="text" name="stock_quantity" class="form-control form-control-sm stock-quantity" value="{{ old('stock_quantity') }}" onchange="calc()">
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
            var stockMinimum = $('.stock-minimum').val().replaceAll(',', '');
            var stockQuantity = $('.stock-quantity').val().replaceAll(',', '');

            $('.stock-minimum').val(numberFormat(stockMinimum));
            $('.stock-quantity').val(numberFormat(stockQuantity));
        }
    </script>
@endsection
