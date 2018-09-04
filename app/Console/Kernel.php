<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ProcessTwitterFeeds;
use App\Jobs\ProcessTwitterAgenda;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('activations:clean')
                 ->daily();
        
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
 
        $schedule->job(new ProcessTwitterFeeds(15), 'ProcessTwitterFeeds')->everyFifteenMinutes();
        $schedule->job(new ProcessTwitterFeeds(30), 'ProcessTwitterFeeds')->everyThirtyMinutes();
        $schedule->job(new ProcessTwitterFeeds(60), 'ProcessTwitterFeeds')->hourly();
        $schedule->job(new ProcessTwitterFeeds(180), 'ProcessTwitterFeeds')->cron('0 */3 * * *');
        $schedule->job(new ProcessTwitterFeeds(720), 'ProcessTwitterFeeds')->cron('15 */12 * * *');
        $schedule->job(new ProcessTwitterFeeds(360), 'ProcessTwitterFeeds')->cron('10 */6 * * *');
        $schedule->job(new ProcessTwitterFeeds(1440), 'ProcessTwitterFeeds')->daily();


        $schedule->job(new ProcessTwitterAgenda(), 'ProcessTwitterAgenda')->everyMinute();
        

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
