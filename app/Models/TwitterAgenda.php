<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TwitterSent;
class TwitterAgenda extends Model
{
    protected $table = 'twitter_agenda';
    
    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
            'user_id',
            'social_id',
            'name',
            'text',
            'image',
            'link',
            'publication_date',
            'publication_at',
            'frequency',
            'active',
    ];

    

    public function scopeFromUser($query, $id)
    {
        return $query->where('user_id', $id);
    }
      public function scopeFromAccount($query, $id)
    {
        return $query->where('social_id', $id);
    }
    public function scopeAtTime($query, $time)
    {
        $day=$time->toDateString();
        $hour=$time->format('H:i:00');

    return $query->where('publication_date', $day)->where('publication_at',$hour);
    }
       public function scopeActive($query)
    {
        return $query->where('active', true);
    }
     public function social()
    {
        return $this->belongsTo('App\Models\Social');
    }

}
