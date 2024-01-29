<?php

namespace App\Listeners;

use App\Mail\WelcomeEmail;
use App\Events\UserRegister;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegister $event): void
    {
        // dd($event->user);
        Mail::to($event->user)->send( new WelcomeEmail($event->user));
    }
}
