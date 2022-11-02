<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'showroom',
        'order_code',
        'payment_token',
        'payment_code',
        'shortpay_code',
        'transaction_id',
        'transaction_type',
        'ref',
        'phone',
        'account_number',
        'description',
        'date',
        'amount',
        'status',
        'bank',
        
    ];
}
