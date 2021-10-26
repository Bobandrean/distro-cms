<?php

namespace App\Http\Controllers;

use App\Services\LogLoginService;
use App\Services\RoleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class LogLoginController extends Controller
{
    private $logLoginService;
    private $request;
    private $roleService;

    public function __construct(Request $request, LogLoginService $logLoginService, RoleService $roleService)
    {
        $this->logLoginService = $logLoginService;
        $this->request = $request;
        $this->roleService = $roleService;
    }

    public function index()
    {
        $items = $this->logLoginService->datatable($this->request);

        $roles = $this->roleService->all();

        $request = $this->request;

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.log-login.index', compact('items', 'request', 'roles'));
    }

    public function export()
    {
        $rows = $this->logLoginService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/log-login.table.col_1') => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                __('pages/log-login.table.col_2') => $row->users->username,
                __('pages/log-login.table.col_3') => $row->tipe_akun->nama
            ];
        endforeach;

        return FastExcel::data($data)->download('log_login_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
