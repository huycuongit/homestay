<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register command
     *
     * @var array
     */
    protected $commands = [
    ];


    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('command:class-lesson')->everyMinute();
        // $schedule->command('command:practice')->everyMinute();
        // $schedule->command('command:notifications-remind-shareholders')->everyMinute();
        // $schedule->command('command:cancel-shareholders')->everyMinute();
        // $schedule->command('command:cancel-shift-coaches')->everyMinute();
        // $schedule->command('command:notifications-remind-shareholders-for-coach')->everyMinute();
        // $schedule->command('command:news-for-student')->everyMinute();
        // // $schedule->command('command:notifications-remind-shareholders')->cron('*/3 * * * *');
        // $schedule->command('command:student-active')->dailyAt('00:01');
        // $schedule->command('command:student-unlock')->dailyAt('00:01');
        // $schedule->command('command:status-contract')->dailyAt('00:01');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        $this->load(__DIR__ . '/Commands/Contract');

        require base_path('routes/console.php');
    }
}
