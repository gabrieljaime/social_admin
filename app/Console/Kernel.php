<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ProcessTwitterFeeds;

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

        $schedule->job(new ProcessTwitterFeeds(15), 'ProcessTwitterFeeds15')->unlessBetween('1:00', '5:00')->everyFifteenMinutes();
        $schedule->job(new ProcessTwitterFeeds(30), 'ProcessTwitterFeeds30')->unlessBetween('1:00', '5:00')->everyThirtyMinutes();
        $schedule->job(new ProcessTwitterFeeds(60), 'ProcessTwitterFeeds60')->unlessBetween('1:00', '5:00')->hourly();
        $schedule->job(new ProcessTwitterFeeds(180), 'ProcessTwitterFeeds180')->unlessBetween('1:00', '5:00')->cron('0 */3 * * *');
        $schedule->job(new ProcessTwitterFeeds(360), 'ProcessTwitterFeeds360')->unlessBetween('1:00', '5:00')->cron('10 */6 * * *');
        $schedule->job(new ProcessTwitterFeeds(720), 'ProcessTwitterFeeds720')->unlessBetween('1:00', '5:00')->cron('15 */12 * * *');
        $schedule->job(new ProcessTwitterFeeds(1440), 'ProcessTwitterFeeds1440')->unlessBetween('1:00', '5:00')->daily();
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
