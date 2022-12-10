<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginLogs extends Model
{

    protected $fillable = [
        'user_id', 'last_login', 'user_agent', 'ip_address'
    ];
}
