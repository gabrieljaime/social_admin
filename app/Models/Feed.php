<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;


class Feed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feeds';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];
    protected $date =[
        'last_public',
    ];
    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'social_id',
        'feed',
        'name',
        'begin',
        'end',
        'term_to_check',
        'post_by_check',
        'daily_posts',
        'shorten_url',
        'last_public',
        'active',
    ];

    protected $casts = [
        'post_by_check' => 'integer',
        'shorten_url'=> 'boolean',
        'shorten_url'=> 'boolean'
    ];

    /**
     * A profile belongs to a user.
     *
     * @return mixed
     */

         public function social()
    {
        return $this->belongsTo('App\Models\Social');
    }
     public function scopeFromTerm($query, $id)
    {
        return $query->where('term_to_check', $id);
    }
     public function scopeFromAccount($query, $id)
    {
        return $query->where('social_id', $id);
    }
    public function scopeFromUser($query)
    {
        $socials = Social::FromUser( Auth::user()->id)->get(['id']);


        return $query->whereIn('social_id',$socials);
    }
     public function scopeActive($query)
    {
        return $query->where('active', true);
    }
       public function DailyPosts()
    {
        $sents=FeedSent::OfFeed($this->id)->fromToday();

        return  $sents->count();
    }
    
   
}
