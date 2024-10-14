<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendWelcomeEmail
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
     * @param  \App\Events\UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
//        there must be something like this, but it goes beyond the scope of the test task
//        Mail::to($event->user->email)->send(new WelcomeEmail($event->user));

        Log::info('New user created with ID: ' . $event->user->id);
    }
}
