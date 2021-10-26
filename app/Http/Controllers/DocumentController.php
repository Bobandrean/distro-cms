<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Pages\Document\UploadLegalRequest;
use App\Http\Requests\Pages\Document\UploadAccountingRequest;
use App\Http\Requests\Pages\Document\UploadOtherRequest;

use App\Services\CustomerService;

ini_set('memory_limit', '-1');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');
ini_set('max_execution_time', '300');
ini_set('max_input_time', '300');

class DocumentController extends Controller
{
    private $request;
    private $customerService;
    private $uploadLegalRequest;
    private $uploadAccountingRequest;
    private $uploadOtherRequest;

    public function __construct(Request $request,
        CustomerService $customerService,
        UploadLegalRequest $uploadLegalRequest,
        UploadAccountingRequest $uploadAccountingRequest,
        UploadOtherRequest $uploadOtherRequest)
    {
        $this->request = $request;
        $this->customerService = $customerService;
        $this->uploadLegalRequest = $uploadLegalRequest;
        $this->uploadAccountingRequest = $uploadAccountingRequest;
        $this->uploadOtherRequest = $uploadOtherRequest;
    }

    public function index()
    {
        $request = $this->request;
        $items = $this->customerService->getById($request->id);

        return view('contents.document.index', compact('items'));
    }

    public function uploadLegal(UploadLegalRequest $uploadLegalRequest)
    {
        DB::beginTransaction();

        try {

            $uploadLegalRequest->handle();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.store_success_notification'));
    }

    public function uploadAccounting(UploadAccountingRequest $uploadAccountingRequest)
    {
        DB::beginTransaction();

        try {

            $uploadAccountingRequest->handle();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.store_success_notification'));
    }

    public function uploadOther(UploadOtherRequest $uploadOtherRequest)
    {
        DB::beginTransaction();

        try {

            $uploadOtherRequest->handle();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        DB::commit();

        return back()->with('success',__('global.store_success_notification'));
    }
}
