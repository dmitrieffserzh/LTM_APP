<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail {

    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'route',
        'password',
        'remember_token',
        'registration_ip',
        'registration_agent'
    ];

    public function getRouteKeyName() {
        return 'route';
    }



    // RELATIONS
    public function profile() {
        return $this->hasOne(Profile::class);
    }
}
