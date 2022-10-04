<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
    use HasFactory;
    protected $guard = 'truck';
    protected $fillable = [
        'company_id', 'contact','name','position','added_by'
    ];

    public function company(){

        return $this->belongsToMany(Company::class);
    
    }

    public function user()
    {
        return $this->belongsTo(TruckUser::class, 'added_by','id');
    }
}
