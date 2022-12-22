<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showroomaccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank',
        'account_number',
        'showroom_id',
        
        
    ];
    public function showroom()
    {
        return $this->belongsTo(Showroom::class, 'id','showroom_id');
    }
}
