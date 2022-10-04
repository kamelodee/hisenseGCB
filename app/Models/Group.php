<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function contacts(){

        return $this->hasMany(Contact::class);
    
    }


    public function smsgroups(){

        return $this->hasMany(SmsGroup::class);
    
    }
}
