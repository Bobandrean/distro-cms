<?php

namespace App\Http\Controllers;

use App\Services\CmsLogService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccessController extends Controller
{
    private $request;
    private $roleService;
    private $cmsLogService;

    public function __construct(Request $request, RoleService $roleService, CmsLogService $cmsLogService)
    {
        $this->request = $request;
        $this->roleService = $roleService;
        $this->cmsLogService = $cmsLogService;
    }
    

    public function index()
    {
        $roles = $this->roleService->all();
        $request = $this->request;
        $permissions = [];
        $item = null;

        if (isset($this->request->role_id) && !empty($this->request->role_id))
        {
            $item = $this->roleService->getById($this->request->role_id);
            $permissions = json_decode($item->permissions, true);
        }

        return view('contents.access.index', compact('roles', 'request', 'permissions', 'item'));
    }

    public function update($id)
    {
        DB::beginTransaction();

        try
        {
            $permissions = [
                'all' => isset($this->request->all) ? $this->request->all : [],
                'show' => isset($this->request->show) ? $this->request->show : [],
                'create' => isset($this->request->create) ? $this->request->create : [],
                'edit' => isset($this->request->edit) ? $this->request->edit : [],
                'destroy' => isset($this->request->destroy) ? $this->request->destroy : []
            ];

            $data['permissions'] = json_encode($permissions, true);

            $this->roleService->update($id, $data);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengupdate Hak Akses Tipe Akun Dengan ID ' . $id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('access.index', ['role_id' => $id])->with('success', __('global.update_success_notification'));
    }
}
