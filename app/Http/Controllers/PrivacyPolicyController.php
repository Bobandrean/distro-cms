<?php

namespace App\Http\Controllers;

use App\Services\CmsLogService;
use App\Services\PrivacyPolicyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivacyPolicyController extends Controller
{
    private $request;
    private $privacyPolicyService;
    private $cmsLogService;

    public function __construct(Request $request, PrivacyPolicyService $privacyPolicyService, CmsLogService $cmsLogService)
    {
        $this->request = $request;
        $this->privacyPolicyService = $privacyPolicyService;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $item = $this->privacyPolicyService->getFirst();

        return view('contents.privacy-policy.index', compact('item'));
    }

    public function update()
    {
        DB::beginTransaction();

        try
        {
            $data['data'] = $this->request->data;

            $this->privacyPolicyService->update($data);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Kebijakan Privasi']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('privacy-policy.index')->with('success', __('global.update_success_notification'));
    }
}
