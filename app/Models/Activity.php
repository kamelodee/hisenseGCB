<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Activity extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_name',
        'showroom',
        'model_id',
        'description',
        'model_name',
        
    ];
    public static function activities($model)
    {
        $activities = self::where('model_name',$model)->latest()->paginate(10);
     
        return  $activities;
    }


    
    public static function activityCreate($model,$description,$id)
    {
       
      return  self::create(['user_id'=>Auth::user()->id,'user_name'=>Auth::user()->name,'showroom'=>Auth::user()->showroom,'description'=>$description,'model_id'=>$id,'model_name'=>$model]);
      
    }

    
   
}
