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

    /**
     * @param int $orderId
     * @return array
     */
    public function statusByOrderId(int $orderId) : array
    {
        $payment = Payment::where(['order_id' => $orderId])->first();

        return [
            'order_id' => $payment->order_id,
            'payment_reference' => $payment->payment_reference,
            'amount' => $payment->amount,
            'status' => $payment->status,
            'updated_at' => $payment->updated_at
        ];
    }
}
