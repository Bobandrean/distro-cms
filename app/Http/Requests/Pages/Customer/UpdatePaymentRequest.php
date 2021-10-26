<?php

namespace App\Http\Requests\Pages\Customer;

use App\Http\Requests\RequestForm;
use Illuminate\Http\Request;

use App\Services\PaymentTypeCustomerService;
use App\Services\PaymentTypeDayService;
use App\Services\PaymentTypeMethodService;

use App\Traits\fileUploadTrait;
use Carbon\Carbon;

class UpdatePaymentRequest extends RequestForm
{
    use fileUploadTrait;

    protected $rules;

    protected $messages;

    public function __construct(Request $request = null, 
        PaymentTypeDayService $paymentTypeDayService,
        PaymentTypeMethodService $paymentTypeMethodService)
    {
        parent::__construct($request);
    
        $this->paymentTypeDayService = $paymentTypeDayService;
        $this->paymentTypeMethodService = $paymentTypeMethodService;

        $this->rules = [
            'top' => 'required',
            'rate' => 'required',
            'method' => 'required'
        ];

        $this->messages = [];
    }

    public function handle()
    {
        $this->isValid();

        $customer_id = $this->request->customer_id;
        $payment_id = $this->request->payment_id;

        $this->paymentTypeDayService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);
        $this->paymentTypeMethodService->destroyByCustomerIdAndPaymentType($customer_id, $payment_id);

        foreach($this->request->top as $key => $val)
        {
            $data['id_tipe_pembayaran'] = $this->request->payment_id;
            $data['id_pembeli'] = $this->request->customer_id;
            $data['hari'] = $this->request->top[$key];
            $data['rate'] = $this->request->rate[$key];

            $this->paymentTypeDayService->store($data);
        }

        foreach($this->request->method as $key2 => $val2)
        {
            $data2['id_tipe_pembayaran'] = $this->request->payment_id;
            $data2['id_pembeli'] = $this->request->customer_id;
            $data2['metode'] = $this->request->method[$key2];

            $this->paymentTypeMethodService->store($data2);
        }

    }
}
