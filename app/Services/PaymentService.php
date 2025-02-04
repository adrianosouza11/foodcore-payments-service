<?php

namespace App\Services;

use App\Models\Payment;
use App\Repositories\PaymentRepository;

class PaymentService
{
    private PaymentRepository $repository;

    public function __construct(PaymentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @return Payment
     */
    public function create(array $data) : Payment
    {
        return $this->repository->create($data);
    }

}
