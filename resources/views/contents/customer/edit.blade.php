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
                        <form action="{{ route('customer.update', $item->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row"><div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.username_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="store_name"
                                           value="{{ $item->users->username }}" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.store_name_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="store_name"
                                           value="{{ $item->nama_usaha }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.first_name_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="first_name"
                                           value="{{ $item->nama_depan }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.last_name_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="last_name"
                                           value="{{ $item->nama_belakang }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.msisdn_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="msisdn"
                                           value="{{ $item->msisdn }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.email_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="email"
                                           value="{{ $item->email }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.rate_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="rate"
                                           value="{{ $item->rate }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.paylater_label')</label>
                                    <select class="form-control form-control-sm" name="paylater"
                                            value="{{ $item->bayar_tunda }}">
                                        <option value="0" selected>Tidak</option>
                                        <option value="1">Ya</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form.address_label')</label>
                                    <textarea class="form-control form-control-sm"
                                              name="address">{{ $item->alamat }}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.province_label')</label>
                                    <select class="form-control form-control-smmb-3 select-province" name="province">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.regency_label')</label>
                                    <select class="form-control form-control-smmb-3 select-regency" name="regency">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.district_label')</label>
                                    <select class="form-control form-control-smmb-3 select-district" name="district">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.village_label')</label>
                                    <select class="form-control form-control-smmb-3 select-village" name="village">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.postcode_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="postcode"
                                           value="{{ $item->kode_pos }}">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.latitude_label')</label>
                                    <input type="text" class="form-control form-control-sm lat" name="latitude"
                                           value="{{ $item->latitude }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.longitude_label')</label>
                                    <input type="text" class="form-control form-control-sm long" name="longitude"
                                           value="{{ $item->longitude }}">
                                </div>

                                <div id="map">
                                    <input id="pac-input" class="controls"
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
                                    <input type="text" class="form-control form-control-sm" name="kyc_name"
                                           value="{{ $item->nama_kyc }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_id_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="kyc_id"
                                           value="{{ $item->no_identitas }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_gender_label')</label>
                                    <select class="form-control form-control-sm" name="kyc_gender"
                                            value="{{ $item->jenis_kelamin }}">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                        <option value="Pria" @if($item->jenis_kelamin == "Pria") selected @endif>Pria
                                        </option>
                                        <option value="Wanita" @if($item->jenis_kelamin == "Wanita") selected @endif>
                                            Wanita
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_birth_place_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="kyc_birth_place"
                                           value="{{ $item->tempat_lahir }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_birth_date_label')</label>
                                    <input type="date" class="form-control form-control-sm" name="kyc_birth_date"
                                           value="{{ Carbon\Carbon::parse($item->tanggal_lahir)->format('Y-m-d') }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_job_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="kyc_job"
                                           value="{{ $item->pekerjaan }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_nationality_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="kyc_nationality"
                                           value="{{ $item->warga_negara }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_religion_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="kyc_religion"
                                           value="{{ $item->agama }}">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_marriage_label')</label>
                                    <select class="form-control form-control-sm" name="kyc_marriage"
                                            value="{{ $item->status_kawin }}">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                        <option value="Belum Kawin"
                                                @if($item->status_kawin == "Belum Kawin") selected @endif>Belum Kawin
                                        </option>
                                        <option value="Kawin" @if($item->status_kawin == "Kawin") selected @endif>
                                            Kawin
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_blood_type_label')</label>
                                    <select class="form-control form-control-sm" name="kyc_blood_type">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                        <option value="A" @if($item->golongan_darah == "A") selected @endif>A</option>
                                        <option value="B" @if($item->golongan_darah == "B") selected @endif>B</option>
                                        <option value="AB" @if($item->golongan_darah == "AB") selected @endif>AB
                                        </option>
                                        <option value="O" @if($item->golongan_darah == "O") selected @endif>O</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_expiry_date_label')</label>
                                    <input type="date" class="form-control form-control-sm" name="kyc_expiry_date"
                                           value="{{ Carbon\Carbon::parse($item->masa_berlaku)->format('Y-m-d') }}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>@lang('pages/customer.form.kyc_address_label')</label>
                                    <textarea class="form-control form-control-sm textarea"
                                              name="kyc_address">{{ $item->alamat_kyc }}</textarea>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_province_label')</label>
                                    <select type="text" class="form-control form-control-sm mb-3 select-province-kyc"
                                            name="kyc_province">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_regency_label')</label>
                                    <select class="form-control form-control-sm mb-3 select-regency-kyc"
                                            name="kyc_regency">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>@lang('pages/customer.form.kyc_district_label')</label>
                                    <select class="form-control form-control-sm mb-3 select-district-kyc"
                                            name="kyc_district">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.kyc_village_label')</label>
                                    <select class="form-control form-control-sm mb-3 select-village-kyc"
                                            name="kyc_village">
                                        <option value="" selected disabled>@lang('global.choose_selectbox_txt')</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>@lang('pages/customer.form.kyc_postcode_label')</label>
                                    <input type="text" class="form-control form-control-sm" name="kyc_postcode"
                                           value="{{ $item->kode_pos_kyc }}">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_workplace_photo_label')</label><br/>
                                    <img src="{{ $item->foto_toko }}" width="100px"><br/><br/>
                                    <input type="file" class="form-control form-control-sm" name="kyc_workplace_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_profile_photo_label')</label><br/>
                                    <img src="{{ $item->foto_diri }}" width="100px"><br/><br/>
                                    <input type="file" class="form-control form-control-sm" name="kyc_profile_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_photo_label')</label><br/>
                                    <img src="{{ $item->foto_ktp }}" width="100px"><br/><br/>
                                    <input type="file" class="form-control form-control-sm" name="kyc_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_signature_photo_label')</label><br/>
                                    <img src="{{ $item->foto_tanda_tangan }}" width="100px"><br/><br/>
                                    <input type="file" class="form-control form-control-sm" name="kyc_signature_photo">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>@lang('pages/customer.form.kyc_business_entity_form_photo_label')</label><br/>
                                    <img src="{{ $item->foto_form_badan_usaha }}" width="100px"><br/><br/>
                                    <input type="file" class="form-control form-control-sm"
                                           name="kyc_entity_form_photo">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-sm btn-primary"><i
                                    class="fas fa-fw fa-save"></i> @lang('global.submit_button_txt')</button>
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

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZn3leVib0hkxw9yXvGDUq_cL27Dw7WHI&libraries=places"></script>
    <script src="{{ asset('js/googleMaps2.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.textarea'))
            .then(editor => {
            })
            .catch(error => {
            });
    </script>
@endsection
