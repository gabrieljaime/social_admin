<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Task;
use App\Models\User;

class ProcessTwitterFeeds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public  $donde;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $donde)
    {
         $this->donde=$donde;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $twitter = New Task();
    
       $twitter->user_id=1;
        $twitter->name =$this->donde;
        $twitter->completed=0;
        $twitter->save();

       // $twitter->ProcessTwittersFeeds(now()->hour);
  
    }
}
