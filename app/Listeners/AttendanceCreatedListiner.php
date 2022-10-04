<?php

namespace App\Listeners;

use App\Events\AttendanceEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
class AttendanceCreatedListiner
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
     * @param  \App\Events\AttendanceEvent  $event
     * @return void
     */
    public function handle(AttendanceEvent $event)
    {
        Log::info("Device created process running...".$event->attendance);
    }
}
