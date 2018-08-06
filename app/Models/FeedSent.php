<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedSent extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'feed_sent';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * Fillable fields for a Profile.
     *
     * @var array
     */
    protected $fillable = [
        'feed_id',
        'tweet_id',
        'feed_item_id'
    ];

    public function social()
    {
        return $this->belongsTo('App\Models\Social');
    }

     public function feed()
    {
        return $this->belongsTo('App\Models\Feed');
    }
     public function scopeOfFeed($query, $id)
    {
        return $query->where('feed_id', $id);
    }

}
