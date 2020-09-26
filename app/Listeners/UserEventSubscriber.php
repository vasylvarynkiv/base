<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleUserLogin($event)
    {
        $event->user->update([
            'last_login_at' => Carbon::now()->toDateTimeString()
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen('Illuminate\Auth\Events\Login', 'App\Listeners\UserEventSubscriber@handleUserLogin');
    }
}
