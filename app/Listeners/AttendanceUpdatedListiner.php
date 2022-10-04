<?php

namespace App\Listeners;

use App\Events\AttendanceUdateEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class AttendanceUpdatedListiner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AttendanceUdateEvent  $event
     * @return void
     */
    public function handle(AttendanceUdateEvent $event)
    {
        Log::info("Device updated process running...".$event->attendance);
    }
}
