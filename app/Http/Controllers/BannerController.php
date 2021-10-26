<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\Banner\UpdateRequest;
use App\Services\CmsLogService;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use App\Services\BannerService;
use App\Http\Requests\Pages\Banner\CreateRequest;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;
use Carbon\Carbon;

class BannerController extends Controller
{
    use fileUploadTrait;
    private $request;
    private $bannerService;
    private $cmsLogService;

    public function __construct(Request $request, BannerService $bannerService, CmsLogService $cmsLogService)
    {
        $this->bannerService = $bannerService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $items = $this->bannerService->datatable($this->request);

        $request = $this->request;

        if ($this->request->export == '1'):
            return $this->export();
        endif;

        return view('contents.banner.index',compact('items','request'));
    }

    public function export()
    {
        $rows = $this->bannerService->export($this->request);

        foreach($rows as $row):
            $data[] = [
                __('pages/banner.table.col_1') => $row->name,
                __('pages/banner.table.col_2') => $row->img_url,
            ];
        endforeach;

        return FastExcel::data($data)->download('banner_'.Carbon::now()->format('Ymd').'.xlsx');
    }

    public function create()
    {
        return view('contents.banner.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $createRequest->handle();
            $this->bannerService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Banner']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('banner.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->bannerService->getById($id);

        return view('contents.banner.edit',compact('item'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $updateRequest->handle();
            $this->bannerService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Banner Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('banner.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $item = $this->bannerService->getById($id);

            if ($item->img_url != NULL)
            {
                $name = 'banner_'.str_replace(' ','_',$item->name).'.png';
                $this->deleteFile('banner', $name);
            }

            $this->bannerService->destroy($id);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Banner Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('banner.index')->with('success', __('global.destroy_success_notification'));
    }
}
