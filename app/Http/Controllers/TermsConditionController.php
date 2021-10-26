<?php

namespace App\Http\Controllers;

use App\Services\CmsLogService;
use App\Services\TermsConditionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TermsConditionController extends Controller
{
    private $request;
    private $termsConditionService;
    private $cmsLogService;

    public function __construct(Request $request, TermsConditionService $termsConditionService, CmsLogService $cmsLogService)
    {
        $this->request = $request;
        $this->termsConditionService = $termsConditionService;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $item = $this->termsConditionService->getFirst();

        return view('contents.terms-condition.index', compact('item'));
    }

    public function update()
    {
        DB::beginTransaction();

        try
        {
            $data['data'] = $this->request->data;

            $this->termsConditionService->update($data);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Syarat & Ketentuan']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('terms-condition.index')->with('success', __('global.update_success_notification'));
    }
}
