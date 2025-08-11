<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout; // <- đúng nè
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
     * @param  \Illuminate\Auth\Events\Logout  $event // <- đúng nè
     * @return void
     */
    public function handle(Logout $event)
    {
        if ($event->guard !== 'web') return;

        $customer = $event->user->customer ?? null;

        if ($customer) {
            log_activity($customer, 'logout', 'Khách đăng xuất', [
                'guard' => $event->guard,
            ]);
        }
    }
}
