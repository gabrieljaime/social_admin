<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TwitterWhiteList extends Model
{
    protected $table = 'twitter_whitelist';
    
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'social_id',
        'friend_id'
    ];


    public function scopeOfAccount($query, $id)
    {
        return $query->where('social_id', $id);
    }
      public function social()
    {
        return $this->belongsTo('App\Models\Social');
    }
    
}
