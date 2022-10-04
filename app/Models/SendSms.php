<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendSms extends Model
{
    use HasFactory;


    
    protected $fillable = [
        'message',
        'contact_name',
        'contact_phone',
        'sender',
        'status',
        'user_id'
    ];
}
