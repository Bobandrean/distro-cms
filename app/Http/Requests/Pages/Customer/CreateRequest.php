<?php

namespace App\Http\Requests\Pages\Customer;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Services\UserService;
use App\Traits\fileUploadTrait;
use Carbon\Carbon;

class CreateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null, UserService $userService, CustomerService $customerService)
    {
        parent::__construct($request);

        $this->userService = $userService;
        $this->customerService = $customerService;

        $this->rules = [
            'username' => 'required | unique:users,username',
            'store_name' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'msisdn' => 'required',
            'email' => 'required',
            'rate' => 'required',
            'paylater' => 'required',
            'address' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'postcode' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'kyc_name' => 'required',
            'kyc_id' => 'required',
            'kyc_gender' => 'required',
            'kyc_birth_place' => 'required',
            'kyc_birth_date' => 'required',
            'kyc_job' => 'required',
            'kyc_nationality' => 'required',
            'kyc_religion' => 'required',
            'kyc_marriage' => 'required',
            'kyc_blood_type' => 'required',
            'kyc_expiry_date' => 'required',
            'kyc_address' => 'required',
            'kyc_province' => 'required',
            'kyc_regency' => 'required',
            'kyc_district' => 'required',
            'kyc_village' => 'required',
            'kyc_postcode' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        // Data User
        $users['username'] = $this->request->username;
        $users['password'] = md5('123456');
        $users['id_tipe_akun'] = '3';
        $users['message'] = 'Menambahkan Akun Pembeli';
        $users['status'] = '1';

        $create_user = $this->userService->store($users);

        // Data Pembeli
        $data['id_user'] = $create_user->id;
        $data['id_job'] = 2;
        $data['nama_usaha'] = $this->request->store_name;
        $data['nama_depan'] = $this->request->first_name;
        $data['nama_belakang'] = $this->request->last_name;
        $data['msisdn'] = $this->request->msisdn;
        $data['email'] = $this->request->email;
        $data['rate'] = $this->request->rate;
        $data['bayar_tunda'] = $this->request->paylater;
        $data['alamat'] = $this->request->address;
        $data['provinsi'] = $this->request->province;
        $data['kota'] = $this->request->regency;
        $data['kecamatan'] = $this->request->district;
        $data['kelurahan'] = $this->request->village;
        $data['kode_pos'] = $this->request->postcode;
        $data['latitude'] = $this->request->latitude;
        $data['longitude'] = $this->request->longitude;
        $data['nama_kyc'] = $this->request->kyc_name;
        $data['no_identitas'] = $this->request->kyc_id;
        $data['jenis_kelamin'] = $this->request->kyc_gender;
        $data['tempat_lahir'] = $this->request->kyc_birth_place;
        $data['tanggal_lahir'] = Carbon::parse($this->request->kyc_birth_date)->format('d-m-Y');
        $data['pekerjaan'] = $this->request->kyc_job;
        $data['warga_negara'] = $this->request->kyc_nationality;
        $data['agama'] = $this->request->kyc_religion;
        $data['status_kawin'] = $this->request->kyc_marriage;
        $data['golongan_darah'] = $this->request->kyc_blood_type;
        $data['masa_berlaku'] = Carbon::parse($this->request->kyc_expiry_date)->format('d-m-Y');
        $data['alamat_kyc'] = $this->request->kyc_address;
        $data['provinsi_kyc'] = $this->request->kyc_province;
        $data['kota_kyc'] = $this->request->kyc_regency;
        $data['kecamatan_kyc'] = $this->request->kyc_district;
        $data['kelurahan_kyc'] = $this->request->kyc_village;
        $data['kode_pos_kyc'] = $this->request->kyc_postcode;

        $firstname = str_replace(' ','_',$this->request->first_name);
        $key = $firstname.'_'.$create_user->id.'.png';

        if ($this->request->hasFile('kyc_workplace_photo')) {

            $upload = $this->uploadFile($this->request->file('kyc_workplace_photo'),'foto_toko',$key);
            $data['foto_toko']= $upload['ObjectURL'];
        }

        if ($this->request->hasFile('kyc_profile_photo')) {

            $upload_1 = $this->uploadFile($this->request->file('kyc_profile_photo'),'foto_diri',$key);
            $data['foto_diri'] = $upload_1['ObjectURL'];
        }

        if ($this->request->hasFile('kyc_photo')) {

            $upload_2 = $this->uploadFile($this->request->file('kyc_photo'),'foto_ktp',$key);
            $data['foto_ktp'] = $upload_2['ObjectURL'];
        }

        if ($this->request->hasFile('kyc_signature_photo')) {

            $upload_3 = $this->uploadFile($this->request->file('kyc_signature_photo'),'foto_tanda_tangan',$key);
            $data['foto_tanda_tangan'] = $upload_3['ObjectURL'];
        }

        if ($this->request->hasFile('kyc_entity_form_photo')) {

            $upload_4 = $this->uploadFile($this->request->file('kyc_entity_form_photo'),'foto_form_badan_usaha',$key);
            $data['foto_form_badan_usaha'] = $upload_4['ObjectURL'];
        }

        $this->customerService->store($data);
    }
}
