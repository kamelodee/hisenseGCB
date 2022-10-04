<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;
    protected $guard = 'truck';
    protected $fillable = [
        'name', 'number','status','added_by',
    ];

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'id','added_by');
    }
}
