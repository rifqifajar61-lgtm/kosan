<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user'; // karena tabelmu namanya user

    protected $fillable = [
        'username',
        'password',
        'isadmin'
    ];

    protected $hidden = [
        'password'
    ];
}
