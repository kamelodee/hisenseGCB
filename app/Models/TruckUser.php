<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TruckUser extends Authenticatable
{
    use HasFactory;
   
    protected $guard = 'truck';
    protected $fillable = [
        'name', 'email', 'password','added_by','position','phone',
    ];
    protected $hidden = [
      'password', 'remember_token',
    ];

    public function user()
    {
      return $this->belongsTo(TruckUser::class, 'added_by','id');
    }

    public function contacts(){

      return $this->hasMany(CompanyContact::class);
  
  }
    public function companies(){

      return $this->hasMany(Company::class);
  
  }

  public function dirvers(){

    return $this->hasMany(Driver::class);

}

}
