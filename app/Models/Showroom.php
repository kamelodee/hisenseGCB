<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showroom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city',
        'street',
        'phone',
        'account_number',
        
    ];
}
