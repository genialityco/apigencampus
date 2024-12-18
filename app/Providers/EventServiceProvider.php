<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [            
            'SocialiteProviders\\Google\\GoogleExtendSocialite@handle',
        ],
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],

        'Illuminate\Mail\Events\MessageSent' => [
            'App\Listeners\LogSentMessage',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
