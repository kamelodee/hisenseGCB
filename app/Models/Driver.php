<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;
    protected $guard = 'truck';
    protected $fillable = [
        'name', 'email', 'phone','status','added_by',
    ];

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'added_by','id');
    }
}
