<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * wydarzenia uzytkownika - z kalendarza
     */
    public function events(){
        return $this->hasMany('App\Calendar');
    }

    /**
     * zliczenie wydarzen
     */
    public function eventsCount(){
        return $this->events()->count();
    }

    /**
     * posty usera
     */
    public function posts(){
        return $this->hasMany('App\Post');
    }

    /**
     * ilosc postow usera
     */
    public function postsCount(){
        return $this->posts()->count();
    }

    /**
     * logi usera
     */
    public function loginlogs(){
        return $this->hasMany('App\LoginLogs')->orderBY('last_login', 'DESC');
    }

    /**
     * ilosc logow usera
     */
    public function loginlogsCount(){
        return $this->loginlogs()->count();
    }

    /**
     * role usera
     */
    public function roles() {
        return $this->belongsToMany(Roles::class, 'roles_has_users', 'users_id', 'roles_id')->withTimestamps();
    }

    /**
     * role usera
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
