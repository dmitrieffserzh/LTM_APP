<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail {

    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'registration_ip',
        'registration_agent'
    ];

    protected $hidden = [
        'route_default',
        'route',
        'password',
        'remember_token',
        'registration_ip',
        'registration_agent'
    ];

    public function getRouteKeyName() {
        return 'route_default';
    }



    // RELATIONS
    public function profile() {
        return $this->hasOne(Profile::class);
    }
}
