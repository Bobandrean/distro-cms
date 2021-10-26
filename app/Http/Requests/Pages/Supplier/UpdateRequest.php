<?php

namespace App\Http\Requests\Pages\Supplier;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Services\CmsLogService;
use App\Traits\fileUploadTrait;
use App\Services\ShippingService;
use App\Services\SupplierService;
use App\Http\Requests\RequestForm;
use App\Services\WarehouseService;

class UpdateRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    private $warehouseService;
    private $shippingService;
    private $userService;
    private $supplierService;
    private $cmsLogService;

    public function __construct(Request $request = null,WareHouseService $warehouseService, ShippingService $shippingService, UserService $userService,SupplierService $supplierService, CmsLogService $cmsLogService)
    {
        parent::__construct($request);

        $this->warehouseService = $warehouseService;
        $this->shippingService = $shippingService;
        $this->userService = $userService;
        $this->supplierService = $supplierService;
        $this->cmsLogService = $cmsLogService;

        $this->rules = [
            'company_name' => 'required',
            'pic_name' => 'required',
            'msisdn' => 'required|numeric',
            'email' => 'required|email',
            'address' => 'required',
            'province' => 'required',
            'regency' => 'required',
            'district' => 'required',
            'village' => 'required',
            'post_code' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'bank_name' => 'required',
            'bank_account_number' => 'required|numeric',
            'bank_account_holder_name' => 'required',
            'username_supplier' => 'required',
            'username_delivery' => 'required',
            'username_warehouse' => 'required',
            'company_logo' => 'nullable|max:2000|mimes:jpg,jpeg,png'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $supplier = $this->supplierService->getById($this->request->id);

        if ($this->request->hasFile('company_logo'))
        {
            $name = str_replace(' ','_',$supplier->nama_perusahaan) . '.png';
            $this->deleteFile('pemasok', $name);

            $key = str_replace(' ','_',$this->request->company_name).'.png';
            $upload = $this->uploadFile($this->request->file('company_logo'), 'pemasok', $key);
            $file_path = $upload['ObjectURL'];
            $data_supplier['logo'] = $file_path;
        }

        $data_supplier['nama_perusahaan'] = $this->request->company_name;
        $data_supplier['nama_pic'] = $this->request->pic_name;
        $data_supplier['msisdn'] = $this->request->msisdn;
        $data_supplier['email'] = $this->request->email;
        $data_supplier['alamat'] = $this->request->address;
        $data_supplier['provinsi'] = $this->request->province;
        $data_supplier['kota'] = $this->request->regency;
        $data_supplier['kecamatan'] = $this->request->district;
        $data_supplier['kelurahan'] = $this->request->village;
        $data_supplier['kode_pos'] = $this->request->post_code;
        $data_supplier['latitude'] = $this->request->latitude;
        $data_supplier['longitude'] = $this->request->longitude;
        $data_supplier['nomor_rekening'] = $this->request->bank_account_number;
        $data_supplier['nama_bank'] = $this->request->bank_name;
        $data_supplier['nama_pemegang_rekening'] = $this->request->bank_account_holder_name;

        $update_supplier = $this->supplierService->update($this->request->id, $data_supplier);

        $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Pemasok Dengan ID Pemasok ' . $this->request->id]);

        $data_warehouse['nama_pic'] = $this->request->pic_name;
        $data_warehouse['msisdn'] = $this->request->msisdn;
        $data_warehouse['email'] = $this->request->email;
        $data_warehouse['alamat'] = $this->request->address;
        $data_warehouse['provinsi'] = $this->request->province;
        $data_warehouse['kota'] = $this->request->regency;
        $data_warehouse['kecamatan'] = $this->request->district;
        $data_warehouse['kelurahan'] = $this->request->village;
        $data_warehouse['kode_pos'] = $this->request->post_code;
        $data_warehouse['latitude'] = $this->request->latitude;
        $data_warehouse['longitude'] = $this->request->longitude;

        $warehouse = $this->warehouseService->getBySupplierId($this->request->id);

        $update_warehouse = $this->warehouseService->update($warehouse->id, $data_warehouse);

        $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Akun Gudang.']);

        $user_shipping['nama_pic'] = $this->request->pic_name;
        $user_shipping['msisdn'] = $this->request->msisdn;
        $user_shipping['email'] = $this->request->email;
        $user_shipping['alamat'] = $this->request->address;
        $user_shipping['provinsi'] = $this->request->province;
        $user_shipping['kota'] = $this->request->regency;
        $user_shipping['kecamatan'] = $this->request->district;
        $user_shipping['kelurahan'] = $this->request->village;
        $user_shipping['kode_pos'] = $this->request->post_code;

        $shipping = $this->shippingService->getByWarehouseId($warehouse->id);

        $create_shipping = $this->shippingService->update($shipping->id,$user_shipping);

        $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Akun Pengiriman.']);
    }
}

