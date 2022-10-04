<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderId extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'status',
        
    ];
}
