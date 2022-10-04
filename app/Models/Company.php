<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model  implements HasMedia
{
   
    use HasFactory;
    use InteractsWithMedia;

    protected $guard = 'truck';
    protected $fillable = [
        'name', 'email','address','location','phone','logo','added_by'
    ];

    public function contacts(){

        return $this->hasMany(CompanyContact::class);
    
    }

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'added_by','id');
    }

}
