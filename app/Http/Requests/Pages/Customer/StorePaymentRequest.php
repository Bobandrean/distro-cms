<?php

namespace App\Http\Requests\Pages\Customer;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;

use App\Services\PaymentTypeCustomerService;
use App\Services\PaymentTypeDayService;
use App\Services\PaymentTypeMethodService;

use App\Traits\fileUploadTrait;
use Carbon\Carbon;

class StorePaymentRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null, 
        PaymentTypeCustomerService $paymentTypeCustomerService,
        PaymentTypeDayService $paymentTypeDayService,
        PaymentTypeMethodService $paymentTypeMethodService)
    {
        parent::__construct($request);
    
        $this->paymentTypeCustomerService = $paymentTypeCustomerService;
        $this->paymentTypeDayService = $paymentTypeDayService;
        $this->paymentTypeMethodService = $paymentTypeMethodService;

        $this->rules = [
            'payment_type' => 'required',
            'credits' => 'required',
            'top' => 'required',
            'rate' => 'required',
            'method' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $credits = str_replace(',','', $this->request->credits);

        //Table Tipe Pembayaran Pembeli
        $data['id_pembeli'] = $this->request->id;
        $data['id_pembayaran'] = $this->request->payment_type;
        $data['plafon_kredit'] = $credits;
        $data['sisa_plafon'] = $credits;

        $this->paymentTypeCustomerService->store($data);

        foreach($this->request->top as $key => $val)
        {
            $data['id_tipe_pembayaran'] = $this->request->payment_type;
            $data['id_pembeli'] = $this->request->id;
            $data['hari'] = $this->request->top[$key];
            $data['rate'] = $this->request->rate[$key];

            $this->paymentTypeDayService->store($data);
        }

        foreach($this->request->method as $key => $val)
        {
            $data['id_tipe_pembayaran'] = $this->request->payment_type;
            $data['id_pembeli'] = $this->request->id;
            $data['metode'] = $this->request->method[$key];

            $this->paymentTypeMethodService->store($data);
        }

    }
}
