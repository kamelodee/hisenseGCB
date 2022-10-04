<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id', 'truck_id','status','truct_order_id','added_by',
    ];


    // 
    public function drivers(){
        return $this->hasMany(Driver::class,'id','driver_id');
    
    }


    // 
    public function truck_order(){

        return $this->belongsTo(TructOrder::class);
    
    }


   

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'id','added_by');
    }
}
