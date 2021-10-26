<?php

namespace App\Http\Requests\Pages\Document;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Traits\fileUploadTrait;

class UploadLegalRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $customerService;

    public function __construct(Request $request = null, CustomerService $customerService)
    {
        parent::__construct($request);

        $this->customerService = $customerService;

        $this->rules = [
            'akta_pendirian' => 'mimes:pdf,jpeg,jpg,png,zip',
            'akta_perubahan' => 'mimes:pdf,jpeg,jpg,png,zip',
            'nib' => 'mimes:pdf,jpeg,jpg,png,zip',
            'tdp' => 'mimes:pdf,jpeg,jpg,png,zip',
            'siup' => 'mimes:pdf,jpeg,jpg,png,zip',
            'npwp_perusahaan' => 'mimes:pdf,jpeg,jpg,png,zip',
            'spkp' => 'mimes:pdf,jpeg,jpg,png,zip',
            'ktp_pic' => 'mimes:pdf,jpeg,jpg,png,zip',
            'npwp_pic' => 'mimes:pdf,jpeg,jpg,png,zip',
            'skdp' => 'mimes:pdf,jpeg,jpg,png,zip',
            'sk_kemenkumham' => 'mimes:pdf,jpeg,jpg,png,zip'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $user = $this->customerService->getById($this->request->id);

        $firstname = str_replace(' ','_',$user->nama_depan);

        if ($this->request->hasFile('akta_pendirian')) {
            $ext_1 = $this->request->file('akta_pendirian')->getClientOriginalExtension();
            $key_1 = $firstname.'_'.$user->id_user.'.'.$ext_1;
            $upload_1 = $this->uploadFile($this->request->file('akta_pendirian'),'foto_akta_pendirian',$key_1);
            $data['foto_akta_pendirian'] = $upload_1['ObjectURL'];
        }

        if ($this->request->hasFile('akta_perubahan')) {
            $ext_2 = $this->request->file('akta_perubahan')->getClientOriginalExtension();
            $key_2 = $firstname.'_'.$user->id_user.'.'.$ext_2;
            $upload_2 = $this->uploadFile($this->request->file('akta_perubahan'),'foto_akta_perubahan',$key_2);
            $data['foto_akta_perubahan'] = $upload_2['ObjectURL'];
        }

        if ($this->request->hasFile('nib')) {
            $ext_3 = $this->request->file('nib')->getClientOriginalExtension();
            $key_3 = $firstname.'_'.$user->id_user.'.'.$ext_3;
            $upload_3 = $this->uploadFile($this->request->file('nib'),'foto_nib',$key_3);
            $data['foto_nib'] = $upload_3['ObjectURL'];
        }

        if ($this->request->hasFile('tdp')) {
            $ext_4 = $this->request->file('tdp')->getClientOriginalExtension();
            $key_4 = $firstname.'_'.$user->id_user.'.'.$ext_4;
            $upload_4 = $this->uploadFile($this->request->file('tdp'),'foto_tdp',$key_4);
            $data['foto_tdp'] = $upload_4['ObjectURL'];
        }

        if ($this->request->hasFile('siup')) {
            $ext_5 = $this->request->file('siup')->getClientOriginalExtension();
            $key_5 = $firstname.'_'.$user->id_user.'.'.$ext_5;
            $upload_5 = $this->uploadFile($this->request->file('siup'),'foto_siup',$key_5);
            $data['foto_siup'] = $upload_5['ObjectURL'];
        }

        if ($this->request->hasFile('npwp_perusahaan')) {
            $ext_6 = $this->request->file('npwp_perusahaan')->getClientOriginalExtension();
            $key_6 = $firstname.'_'.$user->id_user.'.'.$ext_6;
            $upload_6 = $this->uploadFile($this->request->file('npwp_perusahaan'),'foto_npwp',$key_6);
            $data['foto_npwp_perusahaan'] = $upload_6['ObjectURL'];
        }

        if ($this->request->hasFile('spkp')) {
            $ext_7 = $this->request->file('spkp')->getClientOriginalExtension();
            $key_7 = $firstname.'_'.$user->id_user.'.'.$ext_7;
            $upload_7 = $this->uploadFile($this->request->file('spkp'),'foto_spkp',$key_7);
            $data['foto_spkp'] = $upload_7['ObjectURL'];
        }

        if ($this->request->hasFile('ktp_pic')) {
            $ext_8 = $this->request->file('ktp_pic')->getClientOriginalExtension();
            $key_8 = $firstname.'_'.$user->id_user.'.'.$ext_8;
            $upload_8 = $this->uploadFile($this->request->file('ktp_pic'),'foto_ktp_pic',$key_8);
            $data['foto_ktp_pic'] = $upload_8['ObjectURL'];
        }

        if ($this->request->hasFile('npwp_pic')) {
            $ext_9 = $this->request->file('npwp_pic')->getClientOriginalExtension();
            $key_9 = $firstname.'_'.$user->id_user.'.'.$ext_9;
            $upload_9 = $this->uploadFile($this->request->file('npwp_pic'),'foto_npwp_pic',$key_9);
            $data['foto_npwp_pic'] = $upload_9['ObjectURL'];
        }

        if ($this->request->hasFile('skdp')) {
            $ext_10 = $this->request->file('skdp')->getClientOriginalExtension();
            $key_10 = $firstname.'_'.$user->id_user.'.'.$ext_10;
            $upload_10 = $this->uploadFile($this->request->file('skdp'),'foto_skdp',$key_10);
            $data['foto_skdp'] = $upload_10['ObjectURL'];
        }

        if ($this->request->hasFile('sk_kemenkumham')) {
            $ext_11 = $this->request->file('sk_kemenkumham')->getClientOriginalExtension();
            $key_11 = $firstname.'_'.$user->id_user.'.'.$ext_11;
            $upload_11 = $this->uploadFile($this->request->file('sk_kemenkumham'),'foto_sk_kemenkumham',$key_11);
            $data['foto_sk_kemenkumham'] = $upload_11['ObjectURL'];
        }


        $this->customerService->update($this->request->id, $data);
    }
}
