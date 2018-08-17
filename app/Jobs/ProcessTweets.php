<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Twitter;



class ProcessTweets implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private  $twittdata;
    private $feed_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(  $twittdata, $feed_id=null)
    {
         $this->twittdata=$twittdata;
         $this->feed_id=$feed_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle( Twitter $twitter  )
    {   
      

       $twitter->MakeaTwitt($this->twittdata,$this->feed_id);
  
    }
}
