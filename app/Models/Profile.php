<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'about',
        'offline_at'
    ];

    protected $dates = ['offline_at'];

    public $timestamps = false;

    // RELATIONS
    public function user() {
        return $this->belongsTo(User::class);
    }
}