@extends('layout')

@section('content')
    <style>
        #map {
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
                @lang('pages/customer.title')
            </h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('customer.store') }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.username_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="username" value="{{ old('username') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.store_name_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="store_name" value="{{ old('store_name') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.first_name_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="first_name" value="{{ old('first_name') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.last_name_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="last_name" value="{{ old('last_name') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.msisdn_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="msisdn" value="{{ old('msisdn') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.email_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="email" value="{{ old('email') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.rate_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="rate" value="{{ old('rate') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.paylater_label')</label>
                                    <select class="form-control form-control-sm"
                                            name="paylater">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                        <option value="0"
                                                @if(old('paylater') == "0") selected @endif>
                                            Tidak
                                        </option>
                                        <option value="1"
                                                @if(old('paylater') == "1") selected @endif>Ya
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form.address_label')</label>
                                    <textarea class="form-control form-control-sm"
                                              name="address">{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.province_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-province"
                                        name="province">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.regency_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-regency"
                                        name="regency">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.district_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-district"
                                        name="district">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.village_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-village"
                                        name="village">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.postcode_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="postcode" value="{{ old('postcode') }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.latitude_label')</label>
                                    <input type="text" class="form-control form-control-sm lat"
                                           name="latitude" value="{{ old('latitude') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.longitude_label')</label>
                                    <input type="text" class="form-control form-control-sm long"
                                           name="longitude" value="{{ old('longitude') }}">
                                </div>

                                <div id="map">
                                    <input id="pac-input" class="controls"
                                           placeholder="Klik gambar untuk menentukan Longitude & Latitude"
                                           name="location" type="text">
                                    <div id="map-canvas"></div>
                                </div>
                            </div>

                            <br/><br/>
                            <h3>KYC</h3>
                            <hr>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_name_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_name" value="{{ old('kyc_name') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_id_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_id" value="{{ old('kyc_id') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_gender_label')</label>
                                    <select class="form-control form-control-sm"
                                            name="kyc_gender">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                        <option value="Pria"
                                                @if(old('kyc_gender') == "Pria") selected @endif>
                                            Pria
                                        </option>
                                        <option value="Wanita"
                                                @if(old('kyc_gender') == "Wanita") selected @endif>
                                            Wanita
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_birth_place_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_birth_place"
                                           value="{{ old('kyc_birth_place') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_birth_date_label')</label>
                                    <input type="date" class="form-control form-control-sm"
                                           name="kyc_birth_date"
                                           value="{{ old('kyc_birth_date') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_job_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_job" value="{{ old('kyc_job') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_nationality_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_nationality"
                                           value="{{ old('kyc_nationality') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_religion_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_religion"
                                           value="{{ old('kyc_religion') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_marriage_label')</label>
                                    <select class="form-control form-control-sm"
                                            name="kyc_marriage">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                        <option value="Belum Kawin"
                                                @if(old('kyc_marriage') == "Belum Kawin") selected @endif>
                                            Belum Kawin
                                        </option>
                                        <option value="Kawin"
                                                @if(old('kyc_marriage') == "Kawin") selected @endif>
                                            Kawin
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_blood_type_label')</label>
                                    <select class="form-control form-control-sm"
                                            name="kyc_blood_type">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                        <option value="A"
                                                @if(old('kyc_blood_type') == "A") selected @endif>
                                            A
                                        </option>
                                        <option value="B"
                                                @if(old('kyc_blood_type') == "B") selected @endif>
                                            B
                                        </option>
                                        <option value="AB"
                                                @if(old('kyc_blood_type') == "AB") selected @endif>
                                            AB
                                        </option>
                                        <option value="O"
                                                @if(old('kyc_blood_type') == "O") selected @endif>
                                            O
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_expiry_date_label')</label>
                                    <input type="date" class="form-control form-control-sm"
                                           name="kyc_expiry_date"
                                           value="{{ old('kyc_expiry_date') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form.kyc_address_label')</label>
                                    <textarea class="form-control form-control-sm textarea"
                                              name="kyc_address">{{ old('kyc_address') }}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_province_label')</label>
                                    <select type="text"
                                            class="form-control form-control-sm mb-3 select-province-kyc"
                                            name="kyc_province">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_regency_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-regency-kyc"
                                        name="kyc_regency">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_district_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-district-kyc"
                                        name="kyc_district">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.kyc_village_label')</label>
                                    <select
                                        class="form-control form-control-sm mb-3 select-village-kyc"
                                        name="kyc_village">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.kyc_postcode_label')</label>
                                    <input type="text" class="form-control form-control-sm"
                                           name="kyc_postcode"
                                           value="{{ old('kyc_postcode') }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_workplace_photo_label')</label><br/>
                                    <input type="file" class="form-control form-control-sm"
                                           name="kyc_workplace_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_profile_photo_label')</label><br/>
                                    <input type="file" class="form-control form-control-sm"
                                           name="kyc_profile_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_photo_label')</label><br/>
                                    <input type="file" class="form-control form-control-sm"
                                           name="kyc_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_signature_photo_label')</label><br/>
                                    <input type="file" class="form-control form-control-sm"
                                           name="kyc_signature_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_business_entity_form_photo_label')</label><br/>
                                    <input type="file" class="form-control form-control-sm"
                                           name="kyc_entity_form_photo">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-save"></i> @lang('global.create_button_txt')
                            </button>
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
                $('.select-province').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-province').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                }

            });

            $('.select-province').on('change', function () {
                var province = $('.select-province').val();

                jQuery.get('{{ url('api/regency') }}/' + province, function (response) {
                    $('.select-regency').html('');
                    $('.select-regency').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-regency').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                    }
                });
            });

            $('.select-regency').on('change', function () {
                var city = $('.select-regency').val();
                jQuery.get('{{ url('api/district') }}/' + city, function (response) {
                    $('.select-district').html('');
                    $('.select-district').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-district').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                    }
                });
            });

            $('.select-district').on('change', function () {
                var district = $('.select-district').val();
                jQuery.get('{{ url('api/village') }}/' + district, function (response) {
                    $('.select-village').html('');
                    $('.select-village').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-village').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                    }
                });
            });

            jQuery.get('{{ route("province.all") }}', function (response) {

                $('.select-province-kyc').html('');
                $('.select-province-kyc').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                for (var i = 0; i < response.data.length; i++) {
                    $('.select-province-kyc').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                }

            });

            $('.select-province-kyc').on('change', function () {
                var province = $('.select-province-kyc').val();

                jQuery.get('{{ url('api/regency') }}/' + province, function (response) {
                    $('.select-regency-kyc').html('');
                    $('.select-regency-kyc').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-regency-kyc').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                    }
                });
            });

            $('.select-regency-kyc').on('change', function () {
                var city = $('.select-regency-kyc').val();
                jQuery.get('{{ url('api/district') }}/' + city, function (response) {
                    $('.select-district-kyc').html('');
                    $('.select-district-kyc').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-district-kyc').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                    }
                });
            });

            $('.select-district-kyc').on('change', function () {
                var district = $('.select-district-kyc').val();
                jQuery.get('{{ url('api/village') }}/' + district, function (response) {
                    $('.select-village-kyc').html('');
                    $('.select-village-kyc').append('<option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>');
                    for (var i = 0; i < response.data.length; i++) {
                        $('.select-village-kyc').append('<option value="' + response.data[i].id + '">' + response.data[i].nama + '</option>');
                    }
                });
            });
        });
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZn3leVib0hkxw9yXvGDUq_cL27Dw7WHI&libraries=places"></script>
    <script src="{{ asset('js/googleMaps2.js') }}"></script>
@endsection
