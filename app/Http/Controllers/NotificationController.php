<?php

namespace App\Http\Controllers;


use App\Http\Requests\Pages\Notification\UpdateRequest;
use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Services\CmsLogService;
use App\Http\Requests\Pages\Notification\CreateRequest;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    private $notificationService;
    private $request;
    private $cmsLogService;

    public function __construct(Request $request,NotificationService $notificationService,CmsLogService $cmsLogService)
    {
        $this->request = $request;
        $this->notificationService = $notificationService;
        $this->cmsLogService = $cmsLogService;
    }

    public function index()
    {
        $items = $this->notificationService->datatable($this->request);

        $request = $this->request;

        return view('contents.notification.index', compact('items', 'request'));
    }

    public function create()
    {
        return view('contents.notification.create');
    }

    public function store(CreateRequest $createRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $createRequest->handle();
            $this->notificationService->store($data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menambahkan Notification']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('notification.index')->with('success', __('global.store_success_notification'));
    }

    public function edit($id)
    {
        $item = $this->notificationService->getById($id);

        return view('contents.notification.edit',compact('item'));
    }

    public function update($id, UpdateRequest $updateRequest)
    {
        DB::beginTransaction();

        try
        {
            $data = $updateRequest->handle();
            $this->notificationService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mengubah Notification Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('notification.index')->with('success', __('global.update_success_notification'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try
        {
            $item = $this->notificationService->getById($id);

            if ($item->img_url != NULL)
            {
                $name = 'notification_'.str_replace(' ','_',$item->name).'.png';
                $this->deleteFile('notification', $name);
            }

            $this->notificationService->destroy($id);

            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menghapus Notification Dengan ID '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('notification.index')->with('success', __('global.destroy_success_notification'));
    }
}
