<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class TructOrder extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    protected $guard = 'truck';
    protected $fillable = [
        'name', 
        'email', 
        'phone',
        'booking_ref',
        'pickup',
        'pickup_location',
        'dropof_location',
        'pickup_req20',
        'pickup_req40',
        'pickup_req_other',
        'priority',
        'required_date',
        'expected_date',
        'collection_time',
        'special_request',
        'company_id',
    ];
   
  
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id','id');
    }

    public function trucks()
    {
        return $this->hasMany(TruckAssign::class, 'truct_order_id','id');
    }

    public function drivers()
    {
        return $this->hasMany(AssignDriver::class, 'truct_order_id','id');
    }
}
