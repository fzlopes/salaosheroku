<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'address', 'phone', 'celphone', 'whats'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }
}


