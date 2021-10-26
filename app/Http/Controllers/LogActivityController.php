<?php

namespace App\Http\Controllers;

use App\Services\CmsLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class LogActivityController extends Controller
{
    private $cmsLogService;
    private $request;

    public function __construct(CmsLogService $cmsLogService, Request $request)
    {
        $this->cmsLogService = $cmsLogService;
        $this->request = $request;
    }

    public function index()
    {
        $items = $this->cmsLogService->datatable($this->request);

        $request = $this->request;

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.log-activity.index', compact('items', 'request'));
    }

    public function export()
    {
        $rows = $this->cmsLogService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/log-activity.table.col_1') => Carbon::parse($row->created_at)->format('d-m-Y H:i:s'),
                __('pages/log-activity.table.col_2') => $row->users->username,
                __('pages/log-activity.table.col_3') => strip_tags($row->log)
            ];
        endforeach;

        return FastExcel::data($data)->download('log_activity_'.Carbon::now()->format('Ymd').'.xlsx');
    }
}
