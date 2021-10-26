<?php

namespace App\Http\Requests\Pages\Document;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Traits\fileUploadTrait;

class UploadOtherRequest extends RequestForm
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
            'foto_perusahaan' => 'mimes:pdf,jpeg,jpg,png,zip',
            'ttd' => 'mimes:pdf,jpeg,jpg,png,zip',
            'mou' => 'mimes:pdf,jpeg,jpg,png,zip',
            'mou2' => 'mimes:pdf,jpeg,jpg,png,zip',
            'company_profile' => 'mimes:pdf,jpeg,jpg,png,zip'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $user = $this->customerService->getById($this->request->id);

        $firstname = str_replace(' ','_',$user->nama_depan);

        if ($this->request->hasFile('foto_perusahaan')) {
            $ext_1 = $this->request->file('foto_perusahaan')->getClientOriginalExtension();
            $key_1 = $firstname.'_'.$user->id_user.'.'.$ext_1;
            $upload_1 = $this->uploadFile($this->request->file('foto_perusahaan'),'foto_perusahaan',$key_1);
            $data['foto_perusahaan'] = $upload_1['ObjectURL'];
        }

        if ($this->request->hasFile('ttd')) {
            $ext_2 = $this->request->file('ttd')->getClientOriginalExtension();
            $key_2 = $firstname.'_'.$user->id_user.'.'.$ext_2;
            $upload_2 = $this->uploadFile($this->request->file('ttd'),'foto_ttd_digital',$key_2);
            $data['foto_ttd_digital'] = $upload_2['ObjectURL'];
        }

        if ($this->request->hasFile('mou')) {
            $ext_3 = $this->request->file('mou')->getClientOriginalExtension();
            $key_3 = $firstname.'_'.$user->id_user.'.'.$ext_3;
            $upload_3 = $this->uploadFile($this->request->file('mou'),'foto_mou',$key_3);
            $data['foto_mou'] = $upload_3['ObjectURL'];
        }
        if ($this->request->hasFile('mou2')) {
            $ext_3 = $this->request->file('mou2')->getClientOriginalExtension();
            $key_3 = $firstname.'_'.$user->id_user.'.'.$ext_3;
            $upload_3 = $this->uploadFile($this->request->file('mou2'),'foto_mou2',$key_3);
            $data['foto_mou2'] = $upload_3['ObjectURL'];
        }
        if ($this->request->hasFile('company_profile')) {
            $ext_3 = $this->request->file('company_profile')->getClientOriginalExtension();
            $key_3 = $firstname.'_'.$user->id_user.'.'.$ext_3;
            $upload_3 = $this->uploadFile($this->request->file('company_profile'),'company_profile',$key_3);
            $data['company_profile'] = $upload_3['ObjectURL'];
        }

        $this->customerService->update($this->request->id, $data);
    }
}
