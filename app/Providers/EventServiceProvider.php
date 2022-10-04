<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\AttendanceEvent;
use App\Events\AttendanceUdateEvent;
use App\Listeners\AttendanceCreatedListiner;
use App\Listeners\AttendanceUpdatedListiner;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AttendanceEvent::class=>[AttendanceCreatedListiner::class],
        AttendanceUdateEvent::class=>[AttendanceUpdatedListiner::class]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
