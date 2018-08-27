<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Social extends Model
{
     protected $guarded = [
        'id',
    ];
    /**
     * The database table used by the model.
     *
     * @var string
     */
     protected $fillable = [
        'user_id',
        'social_id',
        'social_name',
        'provider',
        'token',
        'secret',
        'image',
        'color',
        'name',
    ];

    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

     public function twitteragenda()
    {
        return $this->hasMany('App\Models\TwitterAgenda');
    }

      public function twittersent()
    {
        return $this->hasMany('App\Models\TwitterSent');
    }
    

     public function feeds()
    {
        return $this->hasMany('App\Models\Feed');
    }
     public function whitelist()
    {
        return $this->hasMany('App\Models\TwitterWhiteList');
    }

    public function scopeFromUser($query, $id)
    {
        return $query->where('user_id', $id);
    }
    
    public function scopeFromProvider($query, $red)
    {
        return $query->where('provider', $red);
    }

}
