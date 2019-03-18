<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Twitch
 * @package App\Facades
 *
 * @method static getStreams($game_ids, $date)
 * @method static aggregate($date)
 */
class Twitch extends Facade
{
    protected static function getFacadeAccessor() { return 'Twitch'; }
}