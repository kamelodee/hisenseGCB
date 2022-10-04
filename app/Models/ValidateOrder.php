<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ValidateOrder extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guard = 'truck';
    protected $fillable = [
        'truck', 'driver','container','added_by','waybill_no','payment_status','truct_order_id','rate','container_size','job_number','status'
    ];

    public function contacts(){

        return $this->hasMany(CompanyContact::class);
    
    }

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'added_by','id');
    }

    public function order()
    {
        return $this->belongsTo(TructOrder::class, 'truct_order_id','id');
    }

    public function trucks()
    {
        return $this->belongsTo(Truck::class, 'truck','id');
    }

    public function drivers()
    {
        return $this->belongsTo(Driver::class, 'driver','id');
    }
}
