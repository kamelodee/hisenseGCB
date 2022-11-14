<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'sales_reference_id',
        
    ];

    public function getTransations($bank)
    {
        $calbank = Transaction::where('bank',$bank)->get();
        return  $calbank;
    }
    public function getCashiertransations($bank)
    {
        $calbank = Transaction::where('bank',$bank)->where('showroom',Auth::user()->showroom)->get();
        return  $calbank;
    }
    public function transations($bank)
    {
        $calbank =Transaction::where('bank',$bank)->where('status', 'SUCCESS')->sum('amount');
        return  $calbank;
    }

    public function cashiertransation($bank)
    {
        $calbank =Transaction::where('bank',$bank)->where('showroom',Auth::user()->showroom)->where('status', 'SUCCESS')->sum('amount');
        return  $calbank;
    }
}
