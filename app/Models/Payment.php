<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments_service.payments';

    protected $fillable = [
        'payment_reference',
        'amount',
        'status',
        'order_id'
    ];
}
