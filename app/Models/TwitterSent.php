<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterSent extends Model
{
    protected $table = 'twitter_sent';
    
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tweet_id',
        'user_id',
        'social_id',
        'text',
        'file',
        'link',
        'origin',
        'origin_id'
    ];
  
    public function social()
    {
        return $this->belongsTo('App\Models\Social');
    }
    public function scopeFromUser($query, $id)
    {
        return $query->where('user_id', $id);
    }


}
