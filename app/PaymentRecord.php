<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    protected $table = 'payment_records';

    protected $fillable = [
        'PID', 'PRN', 'AMT', 'BID', 'UID', 'DV',
    ];
}
