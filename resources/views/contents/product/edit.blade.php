@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="header">
            <h1 class="header-title">
                @lang('pages/product.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('product.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.sku_label')</label>
                                    <input type="text" name="sku" class="form-control form-control-sm" value="{{ $item->kode }}">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.name_label')</label>
                                    <input type="text" name="name" class="form-control form-control-sm" value="{{ $item->nama }}">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.category_label')</label>
                                    <select name="category" class="form-control form-control-sm">
                                        <option value="">@lang('global.choose_selectbox_txt')</option>
                                        @foreach($productCategories as $productCategory)
                                            <option value="{{ $productCategory->id }}" @if($productCategory->id == $item->id_kategori_produk) selected @endif>{{ $productCategory->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="">@lang('pages/product.form.description_label')</label>
                                    <textarea name="description" class="form-control form-control-sm">{{ $item->deskripsi }}</textarea>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">@lang('pages/product.form.measurement_label')</label>
                                    <select name="measurement" class="form-control form-control-sm">
                                        <option value="">@lang('global.choose_selectbox_txt')</option>
                                        @foreach($measurements as $measurement)
                                            <option value="{{ $measurement->id }}" @if($measurement->id == $item->id_satuan_produk) selected @endif>{{ $measurement->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">@lang('pages/product.form.weight_label')</label>
                                    <input type="text" name="weight" class="form-control form-control-sm weight" value="{{ number_format($item->berat, 2, '.', ',') }}" onchange="calc()">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">@lang('pages/product.form.packaging_label')</label>
                                    <select name="packaging" class="form-control form-control-sm">
                                        <option value="">@lang('global.choose_selectbox_txt')</option>
                                        @foreach($packagings as $packaging)
                                            <option value="{{ $packaging->id }}" @if($packaging->id == $item->id_jenis_kemasan) selected @endif>{{ $packaging->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="">@lang('pages/product.form.quantity_label')</label>
                                    <input type="text" name="quantity" class="form-control form-control-sm quantity" value="{{ number_format($item->isi_kemasan, 2, '.', ',') }}" onchange="calc()">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.length_label')</label>
                                    <input type="text" name="length" class="form-control form-control-sm length" value="{{ number_format($item->panjang, 2, '.', ',') }}" onchange="calc()">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.width_label')</label>
                                    <input type="text" name="width" class="form-control form-control-sm width" value="{{ number_format($item->lebar, 2, '.', ',') }}" onchange="calc()">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.height_label')</label>
                                    <input type="text" name="height" class="form-control form-control-sm height" value="{{ number_format($item->tinggi, 2, '.', ',') }}" onchange="calc()">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.base_price_label')</label>
                                    <input type="text" name="base_price" class="form-control form-control-sm base-price" value="{{ number_format($item->harga_dasar, 2, '.', ',') }}" onchange="calc()">
                                </div>
                                <div class="col-md-4 form-group form-check">
                                    <label for=""></label>
                                    <input class="form-check-input tax" name="tax" type="checkbox" value="Ya" @if($item->ppn == 'Ya') checked @endif>
                                    <label class="form-check-label" for="">@lang('pages/product.form.tax_label')</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.price_label')</label>
                                    <input type="text" name="price" class="form-control form-control-sm price" value="{{ number_format($item->harga, 2, '.', ',') }}" readonly>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.photo1_label')</label>
                                    <div><img src="{{ $item->foto_1 }}" width="150" alt="no image"></div>
                                    <input type="file" name="photo1" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.photo2_label')</label>
                                    <div><img src="{{ $item->foto_2 }}" width="150" alt="no image"></div>
                                    <input type="file" name="photo2" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">@lang('pages/product.form.photo3_label')</label>
                                    <div><img src="{{ $item->foto_3 }}" width="150" alt="no image"></div>
                                    <input type="file" name="photo3" class="form-control form-control-sm">
                                </div>
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
            var basePrice = $('.base-price').val().replaceAll(',', '');
            var weight = $('.weight').val().replaceAll(',', '');
            var quantity = $('.quantity').val().replaceAll(',', '');
            var length = $('.length').val().replaceAll(',', '');
            var width = $('.width').val().replaceAll(',', '');
            var height = $('.height').val().replaceAll(',', '');
            var tax = $('.tax');

            $('.base-price').val(currencyFormat(basePrice));
            $('.weight').val(currencyFormat(weight));
            $('.quantity').val(currencyFormat(quantity));
            $('.length').val(currencyFormat(length));
            $('.width').val(currencyFormat(width));
            $('.height').val(currencyFormat(height));

            if (tax.is(":checked")) {
                var price = parseFloat(basePrice * .1) + parseFloat(basePrice);
                $('.price').val(currencyFormat(price));
            } else {
                $('.price').val(currencyFormat(basePrice));
            }
        }

        $('.tax').on('click', function () {
            var tax = $('.tax');
            var basePrice = $('.base-price').val().replaceAll(',', '');

            if (tax.is(":checked")) {
                var price = parseFloat(basePrice * .1) + parseFloat(basePrice);
                $('.price').val(currencyFormat(price));
            } else {
                $('.price').val(currencyFormat(basePrice));
            }
        });
    </script>
@endsection
