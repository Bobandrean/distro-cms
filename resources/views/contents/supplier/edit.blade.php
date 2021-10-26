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
                    <form action="{{ route('supplier.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.company_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="company_name" value="{{ $item->nama_perusahaan }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.pic_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="pic_name" value="{{ $item->nama_pic }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.msisdn_label')</label>
                            <input type="text" class="form-control form-control-sm" name="msisdn" value="{{ $item->msisdn }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.email_label')</label>
                            <input type="text" class="form-control form-control-sm" name="email" value="{{ $item->email }}">
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.address_label')</label>
                            <textarea type="text" class="form-control form-control-sm" row="4" name="address">{{ $item->alamat }}</textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="">@lang('pages/supplier.form.province_label')</label>
                            <select class="form-control form-control-sm mb-3 select-province"
                                    name="province">
                                <option value="{{ $item->provinsi }}" selected>@lang('global.choose_selectbox_txt')</option>
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
                            <input type="text" class="form-control form-control-sm" name="post_code" value="{{ $item->kode_pos }}">
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
                            <input type="text" class="form-control form-control-sm" name="latitude" value="{{ $item->latitude }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.longitude_label')</label>
                            <input type="text" class="form-control form-control-sm" name="longtitude" value="{{ $item->longitude }}">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.bank_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="bank_name" value="{{ $item->nama_bank }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.bank_account_number_label')</label>
                            <input type="text" class="form-control form-control-sm" name="bank_account_number" value="{{ $item->nomor_rekening}}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.bank_account_holder_name_label')</label>
                            <input type="text" class="form-control form-control-sm" name="bank_account_holder_name" value="{{ $item->nama_pemegang_rekening }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.username_supplier_label')</label>
                            <input type="text" class="form-control form-control-sm" name="username_supplier" value="{{ $item->users->username }}" disabled>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="">@lang('pages/supplier.form.company_logo_label')</label>
                            <input type="file" class="form-control form-control-sm" name="company_logo">
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
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-province').append('<option value="' + response.data[i].id + '" @if($item->provinsi == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                }

                $('.select-province').change();
            });

            $('.select-province').change(function () {

                var province = $(this).val();

                jQuery.get('{{ url('api/regency') }}/' + province, function (response) {
                    $('.select-regency').html('');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-regency').append('<option value="' + response.data[i].id + '" @if($item->kota == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                    }
                    $('.select-regency').change();
                });
            });

            $('.select-regency').change(function () {

                var regency = $(this).val();

                jQuery.get('{{ url('api/district') }}/' + regency, function (response) {
                    $('.select-district').html('');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-district').append('<option value="' + response.data[i].id + '" @if($item->kecamatan == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                    }
                    $('.select-district').change();
                });
            });

            $('.select-district').change(function () {

                var district = $(this).val();

                jQuery.get('{{ url('api/village') }}/' + district, function (response) {
                    $('.select-village').html('');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-village').append('<option value="' + response.data[i].id + '" @if($item->kelurahan == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                    }
                });
            });

            jQuery.get('{{ route("province.all") }}', function (response) {

                $('.select-province-kyc').html('');
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-province-kyc').append('<option value="' + response.data[i].id + '" @if($item->provinsi_kyc == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                }

                $('.select-province-kyc').change();
            });

            $('.select-province-kyc').change(function () {

                var provincekyc = $(this).val();

                jQuery.get('{{ url('api/regency') }}/' + provincekyc, function (response) {
                    $('.select-regency-kyc').html('');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-regency-kyc').append('<option value="' + response.data[i].id + '" @if($item->kota_kyc == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                    }
                    $('.select-regency-kyc').change();
                });
            });

            $('.select-regency-kyc').change(function () {

                var regencykyc = $(this).val();

                jQuery.get('{{ url('api/district') }}/' + regencykyc, function (response) {
                    $('.select-district-kyc').html('');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-district-kyc').append('<option value="' + response.data[i].id + '" @if($item->kecamatan_kyc == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                    }
                    $('.select-district-kyc').change();
                });
            });

            $('.select-district-kyc').change(function () {

                var districtkyc = $(this).val();

                jQuery.get('{{ url('api/village') }}/' + districtkyc, function (response) {
                    $('.select-village-kyc').html('');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-village-kyc').append('<option value="' + response.data[i].id + '" @if($item->kelurahan_kyc == '+response.data[i].id+') selected @endif>' + response.data[i].nama + '</option>');
                    }
                });
            });

        });
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZn3leVib0hkxw9yXvGDUq_cL27Dw7WHI&libraries=places"></script>
<script src="{{ asset('js/googleMaps2.js') }}"></script>
@endsection
