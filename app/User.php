<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birth_date', 'picture', 'first_access', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hasRole($role)
    {

        foreach ($this->roles as $user_role) {
            if ($role == $user_role->role) {
                return true;
            }
        }

        return false;
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

    public function clients()
    {
        return $this->hasMany('App\Client');
    }
}
