<?php

namespace App\Repositories;

use App\Models\PaymentTypeMethod;
use App\Traits\baseRepositoryTrait;

class PaymentTypeMethodRepository
{
    use baseRepositoryTrait;

    /**
     * @var PaymentTypeMethod
     */
    private $model;

    /**
     * PaymentTypeMethod constructor.
     * @param PaymentTypeMethod $model
     */
    public function __construct(PaymentTypeMethod $model)
    {
        $this->model = $model;
    }

    public function datatable($request)
    {
        $query = $this->model;

        $query = $query->latest('created_at')->paginate(10, ['*'], 'all');
        return $query;
    }

    public function destroyByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->model->where('id_pembeli', $customerId)->where('id_tipe_pembayaran', $paymentId)->delete();
    }

    public function getByCustomerIdAndPaymentType($customerId, $paymentId)
    {
        return $this->model->where('id_pembeli', $customerId)->where('id_tipe_pembayaran', $paymentId)->get();
    }
    
}
