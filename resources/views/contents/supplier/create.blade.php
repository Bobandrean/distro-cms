@extends('layout')

@section('content')
<style>
    #map{
        height: 500px;
        width: 100%;
        margin: auto auto;
        border: solid 2px #0d6b7a;
        -webkit-transform: translateZ(0);
        z-index: 10;
    }

    #map-canvas {
        height: 100%;
        width: 100%;
        margin: 0px;
        padding: 0px;
        z-index: 0;
    }

    .controls {
        margin-top: 16px;
        border: 1px solid #0d6b7a;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: floralwhite;
        border-radius: 5px;
    }

    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 80%;
        z-index: 1081;
    }

    #pac-input:focus {
        border-color: #0088FF;
    }

    .pac-container {
        font-family: Roboto;
    }

    #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
    }

    #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }

    .pac-container {
        background-color: #FFF;
        z-index: 20;
        position: fixed;
        display: inline-block;
        float: left;
    }
</style>
<div class="container-fluid">
    <div class="header">
        <h1 class="header-title">
            @lang('pages/supplier.title')
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.company_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="company_name" value="{{ old('company_name') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.pic_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="pic_name" value="{{ old('pic_name') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.msisdn_label')</label>
                            <input type="text" class="form-control form-control-sm" name="msisdn" value="{{ old('msisdn') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.email_label')</label>
                            <input type="text" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.address_label')</label>
                            <textarea type="text" class="form-control form-control-sm" row="4" name="address">{{ old('address') }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.province_label')</label>
                            <select class="form-control form-control-sm mb-3 select-province"
                                    name="province">
                                <option value="" selected>@lang('global.choose_selectbox_txt')</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.regency_label')</label>
                            <select class="form-control form-control-sm mb-3 select-regency"
                                    name="regency">
                                <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.district_label')</label>
                            <select class="form-control form-control-sm mb-3 select-district"
                                    name="district">
                                <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.village_label')</label>
                            <select class="form-control form-control-sm mb-3 select-village"
                                    name="village">
                                <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.post_code_label')</label>
                            <input type="text" class="form-control form-control-sm" name="post_code" value="{{ old('post_code') }}">
                        </div>

                        <div id="map">
                            <input id="pac-input" class="controls" placeholder="insert the location"
                                   name="location" type="text">
                            <div id="map-canvas"></div>
                        </div>

                        <div class="form-group col-md-12">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.latitude_label')</label>
                            <input type="text" class="form-control form-control-sm lat" name="latitude" value="{{ old('latitude') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.longitude_label')</label>
                            <input type="text" class="form-control form-control-sm long" name="longitude" value="{{ old('longitude') }}">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.bank_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="bank_name" value="{{ old('bank_name') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.bank_account_number_label')</label>
                            <input type="text" class="form-control form-control-sm" name="bank_account_number" value="{{ old('bank_account_number') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.bank_account_holder_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="bank_account_holder_name" value="{{ old('bank_account_holder_name') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.username_supplier_label')</label>
                            <input type="text" class="form-control form-control-sm" name="username_supplier" value="{{ old('username_supplier') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.username_delivery_label')</label>
                            <input type="text" class="form-control form-control-sm" name="username_delivery" value="{{ old('username_delivery') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.username_warehouse_label')</label>
                            <input type="text" class="form-control form-control-sm" name="username_warehouse" value="{{ old('username_warehouse') }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.company_logo_label')</label>
                            <input type="file" class="form-control form-control-sm" name="company_logo" value="{{ old('company_logo') }}">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-save"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        jQuery.get('{{ route("province.all") }}', function (response) {

            $('.select-province').html('');
            $('.select-province').append('<option value="" selected>@lang('global.choose_selectbox_txt')</option>');
            for (var i = 0; i < response.data.length; i++) {
                $('.select-province').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
            }

        });

        $('.select-province').on('change', function () {
            var province = $('.select-province').val();

            jQuery.get('{{ url('api/regency') }}/' + province, function (response) {
                $('.select-regency').html('');
                $('.select-regency').append('<option value="" selected>@lang('global.choose_selectbox_txt')</option>');
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-regency').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                }
            });
        });

        $('.select-regency').on('change', function () {
            var city = $('.select-regency').val();
            jQuery.get('{{ url('api/district') }}/' + city, function (response) {
                $('.select-district').html('');
                $('.select-district').append('<option value="" selected>@lang('global.choose_selectbox_txt')</option>');
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-district').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                }
            });
        });

        $('.select-district').on('change', function () {
            var district = $('.select-district').val();
            jQuery.get('{{ url('api/village') }}/' + district, function (response) {
                $('.select-village').html('');
                $('.select-village').append('<option value="" selected>@lang('global.choose_selectbox_txt')</option>');
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-village').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                }
            });
        });
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZn3leVib0hkxw9yXvGDUq_cL27Dw7WHI&libraries=places"></script>
<script src="{{ asset('js/googleMaps2.js') }}"></script>
@endsection
