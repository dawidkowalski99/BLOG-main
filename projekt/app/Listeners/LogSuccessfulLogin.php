<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\LoginLogs;
use auth;

class LogSuccessfulLogin
{

    public function __construct(User $user)
    {
        $this->user = Auth::user();
    }

    public function handle()
    {
        $log = new LoginLogs([
            'user_id' => $this->user->id,
            'last_login' => \Carbon\Carbon::now(),
            'user_agent' => \Request::server('HTTP_USER_AGENT'),
            'ip_address' => \Request::ip()
        ]);
        $log->save();
    }
}
