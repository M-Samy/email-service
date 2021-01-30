<?php

namespace App\Providers;

use App\Events\CreateEmailLogEvent;
use App\Events\SendEmailEvent;
use App\Listeners\CreateEmailLogListener;
use App\Listeners\SendEmailListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendEmailEvent::class => [
            SendEmailListener::class,
        ],
        CreateEmailLogEvent::class => [
            CreateEmailLogListener::class,
        ],
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
