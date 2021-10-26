<?php

namespace App\Http\Requests\Pages\Document;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Traits\fileUploadTrait;

class UploadAccountingRequest extends RequestForm
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
            'bukti_transaksi' => 'mimes:pdf,jpeg,jpg,png,zip',
            'rekening_koran' => 'mimes:pdf,jpeg,jpg,png,zip',
            'laporan_keuangan' => 'mimes:pdf,jpeg,jpg,png,zip'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $user = $this->customerService->getById($this->request->id);

        $firstname = str_replace(' ','_',$user->nama_depan);

        if ($this->request->hasFile('bukti_transaksi')) {
            $ext_1 = $this->request->file('bukti_transaksi')->getClientOriginalExtension();
            $key_1 = $firstname.'_'.$user->id_user.'.'.$ext_1;
            $upload_1 = $this->uploadFile($this->request->file('bukti_transaksi'),'foto_bukti_transaksi',$key_1);
            $data['foto_bukti_transaksi'] = $upload_1['ObjectURL'];
        }

        if ($this->request->hasFile('rekening_koran')) {
            $ext_2 = $this->request->file('rekening_koran')->getClientOriginalExtension();
            $key_2 = $firstname.'_'.$user->id_user.'.'.$ext_2;
            $upload_2 = $this->uploadFile($this->request->file('rekening_koran'),'foto_rekening_koran',$key_2);
            $data['foto_rekening_koran'] = $upload_2['ObjectURL'];
        }

        if ($this->request->hasFile('laporan_keuangan')) {
            $ext_3 = $this->request->file('laporan_keuangan')->getClientOriginalExtension();
            $key_3 = $firstname.'_'.$user->id_user.'.'.$ext_3;
            $upload_3 = $this->uploadFile($this->request->file('laporan_keuangan'),'foto_laporan_keuangan',$key_3);
            $data['foto_laporan_keuangan'] = $upload_3['ObjectURL'];
        }

        $this->customerService->update($this->request->id, $data);
    }
}
