<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TruckAssign extends Model
{
    use HasFactory;
    protected $fillable = [
         'truck_id', 'truct_order_id','status','added_by',
    ];


    // 
    public function trucks(){
        return $this->hasMany(Truck::class,'id','truck_id');
    
    }

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'id','added_by');
    }
}
