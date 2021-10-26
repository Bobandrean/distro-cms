<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\BannerGratia\UpdateRequest;
use App\Traits\fileUploadTrait;
use Illuminate\Http\Request;
use App\Services\BannerGratiaService;
use App\Services\CmsLogService;
use App\Http\Requests\Pages\BannerGratia\CreateRequest;
use Illuminate\Support\Facades\DB;


class BannerGratiaController extends Controller
{
    use fileUploadTrait;
    private $request;
    private $bannerGratiaService;
    private $cmsLogService;

    public function __construct(Request $request, BannerGratiaService $bannerGratiaService,CmsLogService $cmsLogService)
    {
        $this->bannerGratiaService = $bannerGratiaService;
        $this->request = $request;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $items = $this->bannerGratiaService->datatable($this->request);

        $request = $this->request;

        return view('contents.banner-gratia.index',compact('items','request'));
    }

    public function create()
    {
        return view('contents.banner-gratia.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $createRequest->handle();
            $this->bannerGratiaService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Banner Gratia Baru.']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('banner-gratia.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->bannerGratiaService->getById($id);

        return view('contents.banner-gratia.edit',compact('item','id'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try {
            $data = $updateRequest->handle();
            $this->bannerGratiaService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Banner Gratia Dengan ID ' . $id]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return redirect()->route('banner-gratia.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $item = $this->bannerGratiaService->getById($id);

            if ($item->img_url != NULL)
            {
                $name = 'bannergratia_'.str_replace(' ','_',$item->name).'.png';
                $this->deleteFile('bannergratia', $name);
            }

            $this->bannerGratiaService->destroy($id);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Banner Gratia Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('banner-gratia.index')->with('success', __('global.destroy_success_notification'));
    }
}
