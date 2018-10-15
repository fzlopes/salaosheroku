<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id', 'date', 'hour', 'observation', 'value', 'service_id'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}


