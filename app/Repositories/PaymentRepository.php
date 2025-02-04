<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository
{
    /***
     * @param array $params
     * @return Payment
     */
    public function create(array $params) : Payment
    {
        return Payment::create($params);
    }
}
