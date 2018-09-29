<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Plans extends Model
{

    use SoftDeletes;

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plans';

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
        'name',
        'stripe_id_m',
        'mercadopago_id_m',
        'stripe_id_y',
        'mercadopago_id_y',
        'price_m',
        'price_y',
        'profile',
        'social',
        'agended',
        'feed',
        'automatic',
        'whitelist',
        'unfollowall',
        'ranking',
        'user_id',
    ];

    protected $hidden = [
        'active',
    ];

    protected $dates = [
        'deleted_at'
    ];



    public function user()
    {
        return $this->belongsTo('App\Models\Users');
    }
   public function scopeFromSubs($query, $id)
    {
        return $query->orWhere('stripe_id_m', $id)->orWhere('stripe_id_y',$id);

    }

      public function scopeForAdmin($query)
    {
        return $query->where('name', 'Admin');

    }
    
     public function scopeActive($query)
    {
        return $query->where('active', true);
    }
     public function scopeFree($query)
    {

        return $query->where('price_m', 0)->where('name','<>', 'Admin');
    }
     public function scopeNoFree($query)
    {

        return $query->where('price_m','<>', 0);
    }
    public function getName($plan)
    {        
       if ($this->stripe_id_m==$plan)
       {
           $name =$this->name.'_m';
       }
       else
       {
           $name = $this->name . '_y';

       }
        

        return $name;
    }

}
