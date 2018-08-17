<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Twitter;
use Log;

class ProcessTwitterFeeds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $time;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $time)
    {
         
         $this->time=$time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $twitter = New Twitter();
       $twitter->ProcessTwittersFeeds($this->time);
  
    }
}
