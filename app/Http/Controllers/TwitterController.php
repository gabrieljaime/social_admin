<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Twitter;
use App\Models\Social;
use App\Models\TwitterWhiteList;
use App\Models\TwitterSent;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Redirect;
use Twitter as TwitterSource;
use Cache;


class TwitterController extends Controller
{
    
 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function index()
    {
        $user = Auth::user();
        $socials = Social::FromUser($user->id)->get();

        $twitters= new Twitter;
        $twitters = $twitters->GetSocials();
      
        return view('twitter.index',compact('twitters', 'socials'));

    }

    public function tweets()
    {
        $user = Auth::user();
        $tweets = TwitterSent::FromUser($user->id)->orderBy('created_at','desc')->take(250)->get();

        
        return view('twitter.tweets',compact('tweets'));

    }
    public function tweetsbyfeed($feed)
    {
        
        $tweets = TwitterSent::FromFeed($feed)->orderBy('created_at','desc')->take(250)->get();

        
        return view('twitter.tweets',compact('tweets'));

    }
     public function deleteTweet($id)
    {
       $tweet= TwitterSent::with('social')->where('twitt_id',$id)->first();

      
       $twitter= new Twitter();
       $twitter->deleteTweet($tweet);
        
       $tweet->delete();
        


        $user = Auth::user();
        $tweets = TwitterSent::FromUser($user->id)->get();
   
        
        return view('twitter.tweets',compact('tweets'))->with('status', 'Tweet Deleted Successfully');

    }
      public function stats($id)
    {
      
       $tweet= TwitterSent::with('social')->where('twitt_id',$id)->first();

       
       $twitter= new Twitter();
       
       
       dd($twitter->getTweet($tweet->link));

      
   
        
        return view('twitter.tweets',compact('tweets'))->with('status', 'Tweet Deleted Successfully');

    }
   public function status($id)
    {
      
        $social = Social::find($id);

        $twitter = new Twitter; 
        
       $social_card= $twitter->GetSocial( $social );

  
        $twitter= $twitter->GetFriendsState( $social,$social_card );
        
        $friends=$twitter[0];
       
      
        return view('twitter.status', compact('id','social_card', 'friends'));
    }
     public function showtype($id,$type)
    {
    
        $social = Social::find($id);

        $twitter = new Twitter; 
        
        $social_card= $twitter->GetSocial( $social );


        $twitter= $twitter->GetFriendsState( $social,$social_card );
        
        $friends=$twitter[0];

         

        switch ($type) {
            case 'nf':
                 $friends=  $friends->where('nofollow', true);
            
                break;
              case 'no':
                 $friends=  $friends->where('noactive', true);
               
                break;
                  case 'sp':
                 $friends=  $friends->where('spam', true);  
               
                break;
                  case 'ta':
                 $friends=  $friends->where('tooactive', true);  
                   
                break;
            default:
                $friends;
                break;
        }
       
      
        return view('twitter.show', compact('social', 'friends','type'));
    }

    public function unfollow($id,$friendid){

        $social = Social::find($id);

        $parent_config['token']  =$social->token;
        $parent_config['secret'] = $social->secret;
                
        TwitterSource::reconfig($parent_config);

        

        if ($friendid=='all')
        {
        

        if (Cache::has('GetSocial-'.$id))
                {   
                
                    $twitter= unserialize(Cache::get('GetSocial-'.$id));
                    Cache::forget('GetSocial-'.$id);

                    $twitter->friends_count=0;
                    Cache::put('GetSocial-'.$id,serialize($twitter), 15);

                    $twitter= unserialize(Cache::get('GetSocial-'.$id));

                    
                }
            if (Cache::has('friends-'.$id))
                {
                
                    $friends= unserialize(Cache::get('friends-'.$id));
                    $borrados =collect();
                    Cache::forget('friends-'.$id);
                    Cache::put('friends-'.$id,serialize($borrados), 15);
                                    
                    
                }
            else
            {
                $friends=collect();
                $a=0;
                $cursor=-1;

                    while ($a <= $social->friends_count) {
                    
                        $friendsT =TwitterSource::getFriendsIds(array('cursor'=> $cursor,'count'=>'200'));
                        $cursor=$friendsT->next_cursor;
                        
                        $friends=$friends->concat( $friendsT->ids);

                        $a=$a+200;
                    }


            }

            foreach ($friends as $friend) {
            
                $unfollow= TwitterSource::postUnfollow(['user_id' => $friend->get('id')]);
            }


            return Redirect::back()->with('status', 'Unfollow All Friends Correctly');
        }
        else
        {


        $unfollow= TwitterSource::postUnfollow(['user_id' => $friendid]);

        $twitter= new Twitter; 

        $twitter->UpdateUnfollow($id, $friendid);

        return Redirect::back()->with('status', 'Unfollow '.$unfollow->name.' Correctly');

        }
        



        

    }

    public function addwhitelist($id,$friend_id){
        
        $whitelist =new TwitterWhiteList();

        $whitelist->social_id=$id;
        $whitelist->friend_id=$friend_id;

        $whitelist->save();

            if (Cache::has('friends-'.$id))
            {
               
                $friends= unserialize(Cache::get('friends-'.$id));
                Cache::forget('friends-'.$id);
                
                $friends= $friends->keyby('id')->forget($friend_id);
                
                
                 
                Cache::put('friends-'.$id, serialize($friends), 15);
                
            }

        return Redirect::back()->with('status', 'Add Friend to WhiteList');

    }

    
     public function deleteTwitterAccount( $id)
    {

        $currentUser = \Auth::user();
        $social = Social::findOrFail($id);

        if ($social->user_id != $currentUser->id) {
            return redirect('twitter/'.$social->user_id)->with('error', trans('twitter.errorDeleteNotYour'));
        }

             if (Cache::has('followers-'.$id))
             {
                 Cache::forget('followers-'.$id);
             }

              if (Cache::has('friends-'.$id))
            {
                  Cache::forget('friends-'.$id);
            } 

          if (Cache::has('GetSocial-'.$id))
            {   
                Cache::forget('GetSocial-'.$id);                 
            }
            if (Cache::has('GetSocials-'.$currentUser->id))
            {
                $socials= unserialize(Cache::get('GetSocials-'.$currentUser->id));
                Cache::forget('GetSocials-'.$currentUser->id);
                $socials= $socials->keyby('id')->forget($social->social_id);
                
                Cache::put('GetSocials-'.$currentUser->id, serialize($socials), 15);
            }   
                      
                   
        $social->delete();


        return redirect('/twitter/')->with('success', trans('twitter.successTwitterAccountDeleted'));
    }
}
