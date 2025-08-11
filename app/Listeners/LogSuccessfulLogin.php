<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
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
     * @param  \Illuminate\Auth\Events\Login  $event // <- đúng luôn
     * @return void
     */
    public function handle(Login $event)
    {
        
        if ($event->guard !== 'web') return;

        $customer = $event->user->customer ?? null;

        if ($customer) {
            log_activity($customer, 'login', 'Khách đăng nhập', [
                'guard' => $event->guard,
            ]);
        }
    }
}
