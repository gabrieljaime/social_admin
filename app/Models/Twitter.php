<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \App\Models\Social;
use \App\Models\TwitterAgenda;
use Gravatar;
use Twitter as TwitterSource;
use \App\Models\Feed;
use \App\Models\FeedSent;
use Auth;
use File;
use Feeds;
use Bitly;
use Log;
use Cloudder;
use \App\Models\TwitterSent;
use \App\Jobs\ProcessTwitterFeeds;
use Illuminate\Session\Store as SessionStore;
use Cookie;
use \App\Models\FriendsShort;
use Cache;
use Carbon\Carbon;
use \App\Jobs\ProcessTweets;


class Twitter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $fillable = [
        'id',
        'social_id',
        'token',
        'name',
        'screen_name',
        'location',
        'created_at',
        'description',
        'followers_count',
        'friends_count',
        'statuses_count',
        'image_url',
        'profile_banner_url',
        'color'
        
    ];

    public function GetSocials ()
    {

         $user = Auth::user();

        $socials = Social::FromUser($user->id)->get();

        $twitters = collect();
    
         if (Cache::has('GetSocials-'.$user->id))
            {
                 $twitters= unserialize(Cache::get('GetSocials-'.$user->id));
            }
            else
        {
                foreach ($socials as $social ) {
                

                    $twit=[];
          
                    $this->SetCredencials ($social->token, $social->secret);

                    $twit = TwitterSource::getCredentials();

                    $twitters->prepend($this->MakeSocial($twit, $social));   
                    
                    
                }
            
   
              Cache::put('GetSocials-'.$user->id,serialize($twitters), 15);
        }

        
        return $twitters;

    }

   
     public function GetSocial (Social $social)
    {
    
       

        if (Cache::has('GetSocial-'.$social->id))
        {
            $twitter= unserialize(Cache::get('GetSocial-'.$social->id));
        }
        else
        {
            $this->SetCredencials ($social->token, $social->secret);

            $twit = TwitterSource::getCredentials();
            
            $twitter=$this->MakeSocial($twit,$social);
           
            Cache::put('GetSocial-'.$social->id,serialize($twitter), 15);
        }
    
        

        return $twitter;

    }

    public function ProcessTwittersFeeds( $time )
    {
                
        
            $feeds = Feed::with('social')->Active()->FromTerm($time)->get();

           //$feeds = Feed::with('social')->Active()->FromUser()->get();



            foreach ($feeds as $fe ) {

                if ( $fe->DailyPosts()>=$fe->daily_posts)
                {
                     break;
                }
               
                $feed = Feeds::make($fe->feed,$fe->post_by_check);

                $feedSent= FeedSent::ofFeed($fe->id)->get();
                
                $items = array_sort(array_slice($feed->get_items(),0,$fe->post_by_check));

                $minutes=0;
            
                $feed_posted= $fe->post_by_check;
            
                foreach ($items as $item) {
                    
                   
                   $item_date= \Carbon\Carbon::createFromFormat('j F Y, g:i a', $item->get_date());
                     
                    if ($feed_posted==0)
                    {
                        break;
                    }


                    if (!($feedSent->contains('feed_item_id',$item->get_id())) && ($item_date>=$fe->last_public) )    
                    {                    

                    $twitt=collect();
    
                    $twitt->user_id = $fe->social->user_id;
                    $twitt->link=  $item->get_permalink();
                    $twitt->social_id=  $fe->social->id;
                    $twitt->text= html_entity_decode($fe->begin.' '.$item->get_title().' '.$fe->end);
                    $twitt->file=  $item->get_enclosure()->link;
                    $twitt->origin_id=  $fe->id;
                    $twitt->origin=  'Feed';

                    $fe->last_public = $item_date;


                    //$this->MakeaTwitt( $twitt, $item->get_id());

                    ProcessTweets::dispatch($twitt, $item->get_id())->onQueue('Tweets')->delay(now()->addMinutes($minutes));

                    $minutes=$minutes+2;

                    $feed_posted--;

                    }
                }
        
                $fe->save();
    
            }   

            
    }
     public function ProcessTwittersAgenda(  )
    {
        
        $time = now();    

        $agendas = TwitterAgenda::with('social')->Active()->AtTime($time)->get();

        //$agendas = TwitterAgenda::with('social')->Active()->get();

        foreach ($agendas as $agenda ){

         

            $agenda=array_add($agenda,  'origin','agenda');

        

            $this->MakeaTwitt($agenda);
       
        }

    }

    private function getLink ($link)
    {
     
            $linksComponents =  explode ('&' , html_entity_decode($link)  );
            if ($linksComponents[0]=="https://www.google.com/url?rct=j")
                {
                    $link=substr($linksComponents[2],4, strlen($linksComponents[2]));
                }
           
             $link = Bitly::shorten($link);

            return $link->data->url;
           
    }


    public function GetFriendsState ( Social $social, $social_card)
    {

            $this->SetCredencials ($social->token,  $social->secret);
        
            $followers=collect();

            Cache::forget('followers-'.$social->id);
            Cache::forget('friends-'.$social->id);
          
            if (Cache::has('followers-'.$social->id))
            {
                 $allfriends= collect(unserialize(Cache::get('followers-'.$social->id)));
            }
            else
            {
    
              $a=0;
               $cursor=-1;

                while ($a <= $social_card->followers_count) {
                
                    $followersT =TwitterSource::getFollowersIds(array('cursor'=> $cursor,'count'=>'5000'));

                    $cursor=$followersT->next_cursor;
                    
                    $followers=$followers->concat( $followersT->ids);

                    $a=$a+5000;
                }

                    Cache::put('followers-'.$social->id,serialize($followers), 15);
            }
        
            
           
        

          
            $friends=collect();

            if (Cache::has('friends-'.$social->id))
            {
               
                $friends= unserialize(Cache::get('friends-'.$social->id));
                
            }
            else
            {
               
                $allfriends=collect();
                $friendsids = collect();

            
                $a=0;
               $cursor=-1;

               
               while ($a <= $social_card->friends_count) {
                
                    $friendsT = TwitterSource::getFriendsIds(array('cursor'=> $cursor,'count'=>'5000'));
        
                    $cursor=$friendsT->next_cursor;
                    $friendsids=$friendsids->concat( collect($friendsT->ids));

                    $a=$a+5000;

                    
                }
                
               
        
      


                foreach ($friendsids->chunk(100) as $friendsid) {

                   $friendsT = TwitterSource::getUsersLookup(array('user_id'=> $friendsid->implode(',')));
                   $allfriends = $allfriends->concat(collect($friendsT));

                }
              

                 $friendshort= new FriendsShort;
               
                 foreach ( $allfriends as $friend) {
                    
                     
                    

                    $friendshort->CreateShortFriend($friend,$followers,$social->id);
                    
                    
                   
                      
                    $friends=$friends->push(collect($friendshort));
                

                 }   
                
                    Cache::put('friends-'.$social->id, serialize($friends), 15);

           
            }

         


        return [$friends,$followers];

    }
    public function UpdateUnfollow ($id, $friend_id){
  
    
          if (Cache::has('GetSocial-'.$id))
            {   
               
                $twitter= unserialize(Cache::get('GetSocial-'.$id));
                Cache::forget('GetSocial-'.$id);

                $twitter->friends_count=$twitter->friends_count-1;
                Cache::put('GetSocial-'.$id,serialize($twitter), 15);

                $twitter= unserialize(Cache::get('GetSocial-'.$id));

                 
            }
            if (Cache::has('friends-'.$id))
            {
               
                $friends= unserialize(Cache::get('friends-'.$id));
                Cache::forget('friends-'.$id);
                
                $friends= $friends->keyby('id')->forget($friend_id);

                 
                Cache::put('friends-'.$id, serialize($friends), 15);
                
            }
                 
    }



    public function MakeaTwitt ($twittdata, $feed_id = null) 
    {
     
        if (! isset($twittdata->social))
        {
             $social = Social::find($twittdata->social_id);

             $this->SetCredencials ($social->token,  $social->secret);

        }
        else
        {
             $this->SetCredencials ($twittdata->social->token,  $twittdata->social->secret);

        }


          
             
    
            $publicated= new TwitterSent;

            $publicated->user_id = $twittdata->user_id;
            $publicated->social_id = $twittdata->social_id;
            $publicated->text=html_entity_decode(strip_tags($twittdata->text));
            
            $publicated->origin  = $twittdata->origin;

            if (isset($twittdata->origin_id)){
                $publicated->origin_id=$twittdata->origin_id;
            }
            else
                {
                     $publicated->origin_id=$twittdata->id;
                }
         

            if ($twittdata->origin=='agenda')
            {
                 $publicated->id;
            }
         
             if (isset($twittdata->social) && $twittdata->image)
                {
                    $publicated->file=cloudinary_url(Cloudder::show("v".$twittdata->image."/twitter/".$twittdata->social_id."/".$twittdata->id,  array("width" => 506, "height" => 253, "crop" => "fill")));         
                }
            
            if (isset($twittdata->link) && $twittdata->link)
            {
                $publicated->link= $this->getLink($twittdata->link) ;
            }
            if (isset($twittdata->file) && $twittdata->file)
            {
                 $publicated->file=$twittdata->file;
            }
           
           // dd($publicated);

            if ( is_null($publicated->file))
            {
             $response=TwitterSource::postTweet(['status' => $publicated->text.' '.$publicated->link]);
   
            }
            else
            {
              $uploaded_media = TwitterSource::uploadMedia(['media' => file_get_contents($publicated->file)  ]);
             $response= TwitterSource::postTweet(['status' => $publicated->text.' '.$publicated->link, 'media_ids' => $uploaded_media->media_id_string]);
   
            }
             
         
            $publicated->twitt_id= $response->id;
            $publicated->save(); 

            if ($feed_id)
            {
                $feed = new FeedSent;
                $feed->feed_id=$publicated->origin_id;
                $feed->tweet_id = $publicated->id;
                $feed->feed_item_id=$feed_id;
                $feed->save();
            }

    }
     public function MakeSocial($twit,$social)
    {
                        
        $twitter= new Twitter;
        $twitter->id    =$twit->id;
        $twitter->social_id =$social->id;
        $twitter->token =$social->token;
        $twitter->name  =$twit->name;
        $twitter->screen_name   =$twit->screen_name;
        $twitter->location  =$twit->location;
        $twitter->created_at= Carbon::createFromFormat('D M d G:i:s O Y',$twit->created_at, 'UTC');
        $twitter->description   =$twit->description;
        $twitter->followers_count   =$twit->followers_count;
        $twitter->friends_count =$twit->friends_count;
        $twitter->statuses_count    =$twit->statuses_count;     
        $twitter->image_url = str_replace("normal", "bigger", $twit->profile_image_url);


        $twitter->color = $twit->profile_link_color;
        if (isset($twit->profile_banner_url))
        {
            $twitter->profile_banner_url =$twit->profile_banner_url.'/600x200';
        }
         
        return $twitter;

    }
    public function SetCredencials ($token, $secret){
                
                $parent_config['token']  =$token;
                $parent_config['secret'] = $secret;
                    
                TwitterSource::reconfig($parent_config);
    }

    public function deleteTweet ($tweet){

            $this->SetCredencials($tweet->social['token'],$tweet->social['secret']);
            
            $response= TwitterSource::destroyTweet($tweet->twitt_id);
           
            return $response;   
    }
     public function getTweet ($id){

        
            $response=  Bitly::linkCountries($id);
            return $response;   
               
    }
    
}