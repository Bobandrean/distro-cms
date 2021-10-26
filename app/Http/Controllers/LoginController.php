<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\LoginService;
use App\Services\LogLoginService;
use App\Services\ShippingService;
use App\Services\SupplierService;
use App\Services\WarehouseService;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    private $request;
    private $loginService;
    private $logLoginService;
    private $supplierService;
    private $shippingService;
    private $warehouseService;
    private $customerService;

    public function __construct(Request $request, LoginService $loginService,
                                LogLoginService $logLoginService, SupplierService $supplierService,
                                ShippingService $shippingService, WarehouseService $warehouseService, CustomerService $customerService)
    {
        $this->request = $request;
        $this->loginService = $loginService;
        $this->logLoginService = $logLoginService;
        $this->supplierService = $supplierService;
        $this->shippingService = $shippingService;
        $this->warehouseService = $warehouseService;
        $this->customerService = $customerService;
    }

    public function store(LoginRequest $loginRequest)
    {
        $auth = $loginRequest->handle();

        if ($auth == null):
            return back()->withErrors(__('pages/login.login_failed'));
        else:
            if ($auth->tipe_akun->slug == 'pemasok'):
                $department = $this->supplierService->getByUserId($auth->id);
            elseif ($auth->tipe_akun->slug == 'gudang'):
                $department = $this->warehouseService->getByUserId($auth->id);
            elseif ($auth->tipe_akun->slug == 'pengiriman'):
                $department = $this->shippingService->getByUserId($auth->id);
            elseif ($auth->tipe_akun->slug == 'pembeli'):
                $department = $this->customerService->getByUserId($auth->id);
            else:
                $department = null;
            endif;

            if ($auth->tipe_akun->slug == 'kreditpro'):
                $payment_id = 1;
            elseif ($auth->tipe_akun->slug == 'investree'):
                $payment_id = 4;
            elseif ($auth->tipe_akun->slug == 'batumbu'):
                $payment_id = 5;
            elseif ($auth->tipe_akun->slug == 'dompet_kilat'):
                $payment_id = 6;
            elseif ($auth->tipe_akun->slug == 'akseleran'):
                $payment_id = 7;
            elseif ($auth->tipe_akun->slug == 'cash'):
                $payment_id = 8;
            elseif ($auth->tipe_akun->slug == 'danamart'):
                $payment_id = 9;
            elseif ($auth->tipe_akun->slug == 'kartu_kredit'):
                $payment_id = 10;
            elseif ($auth->tipe_akun->slug == 'modalku'):
                $payment_id = 11;
            else:
                $payment_id = 0;
            endif;

            session()->put('user', $auth);
            session()->put('department', $department);
            session()->put('payment_id', $payment_id);

            $data['id_user'] = $auth->id;
            $data['id_tipe_akun'] = $auth->id_tipe_akun;
            $this->logLoginService->store($data);

            return redirect()->route('dashboard.index');
        endif;
     }

    public function destroy()
    {
        $this->loginService->logout();

        return redirect()->route('login.index');
    }
}
