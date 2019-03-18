<?php

namespace App\Providers;

use App\Tools\StreamServices\Twitch;
use Illuminate\Support\ServiceProvider;

class TwitchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Twitch', Twitch::class);
    }
}