<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\NewCustomerService;
use App\Services\CmsLogService;
use App\Services\UserService;

class NewCustomerController extends Controller
{
    private $request;
    private $newCustomerService;
    private $cmsLogService;
    private $userService;

    public function __construct(
        Request $request, 
        NewCustomerService $newCustomerService, 
        CmsLogService $cmsLogService,
        UserService $userService)
    {
        $this->request = $request;
		$this->newCustomerService = $newCustomerService;
        $this->cmsLogService = $cmsLogService;
        $this->userService = $userService;
    }

    public function index()
    {
    	$request = $this->request;
    	$items = $this->newCustomerService->datatable($this->request);

        return view('contents.new-customer.index', compact('items','request'));
    }

    public function accept($id)
    {
        DB::beginTransaction();

        try
        {
            $data['status'] = '1';
            
            $this->userService->update($id, $data);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Menerima Pembeli dengan ID User '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return redirect()->route('new-customer.index')->with('success',__('pages/new-customer.accept_notification'));   
    }

    public function reject($id)
    {
        DB::beginTransaction();
        
        try
        {
            $this->userService->destroy($id);
            $this->cmsLogService->store(['log' => session()->get('user')->username.' Mereject Pembeli dengan ID User '.$id]);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }

        DB::commit(); 

        return redirect()->route('new-customer.index')->with('success',__('pages/new-customer.reject_notification'));    
    }
}
