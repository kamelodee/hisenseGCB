<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'phone',
        'group_id',
        'user_id',
    ];

    public function group(){

        return $this->belongsToMany(Group::class);
    
    }

    public function smsgroups(){

        return $this->hasMany(SmsGroup::class);
    
    }
}
