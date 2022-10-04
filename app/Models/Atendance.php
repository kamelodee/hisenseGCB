<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\AttendanceEvent;
use App\Events\AttendanceUdateEvent;
class Atendance extends Model
{
    protected $table="attendances";


    use HasFactory;

    protected $fillable=[
        'EmployeeID',
        'PersonName',
        'CheckIn',
        'CheckInDate',
        'CheckInTime',
        'CheckOut',
        'CheckOutDate',
        'CheckOutTime',
    ];

    protected $dispatchesEvents = [
        "created" => AttendanceEvent::class,
        "updated" => AttendanceUdateEvent::class,
        //..
    ]; 

}
