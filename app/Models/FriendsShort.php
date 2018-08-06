<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Models\TwitterWhiteList;


class FriendsShort extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $fillable = [
         'id',
         'name',
         'screen_name',
         'location',
         'description',
         'followers_count',
         'friends_count',
         'created_at',
         'statuses_count',
         'last_status',
         'profile_image_url',
         'default_profile_image',
         'verified',
         'nofollow',
         'noactive',
         'tooactive',
         'spam',
    ];

     protected $dates = [
        'created_at',
        'last_status',
    ];



public function CreateShortFriend ($friend,$followers,$account)
{
      
      empty($this);

      $whitelist= TwitterWhiteList::OfAccount($account)->get();

      
      
      if (array_has($friend,'status'))
        {
            $this->last_status = Carbon::createFromFormat('D M d G:i:s O Y', collect($friend->status)->shift(), 'UTC');
        }
       
       $this->created_at=Carbon::createFromFormat('D M d G:i:s O Y',$friend->created_at, 'UTC');
       $this->id = $friend->id;
       $this->name= $friend->name;
       $this->screen_name=  $friend->screen_name;
       $this->location= $friend->location;
       $this->description= $friend->description;
       $this->followers_count= $friend->followers_count;
       $this->friends_count= $friend->friends_count;
       $this->statuses_count= $friend->statuses_count;  
       $this->profile_image_url= $friend->profile_image_url;
       $this->default_profile_image= $friend->default_profile_image;
       $this->verified= $friend->verified;

       

        if ($whitelist->contains($friend->id))
        {
            $this->nofollow=false;
            $this->noactive=false;
            $this->tooactive=false;
            $this->spam=false;
            
        }
        else
        {
            $this->nofollow=(!$followers->contains($friend->id));
            $this->noactive=($this->last_status < now('UTC')->subMonth());
            $this->tooactive=($this->statuses_count/(now('UTC')->diffInDays($this->created_at)) >20);
            $this->spam=($this->default_profile_image || ($this->statuses_count==0));
        }

                  
    return  $this;
} 

}