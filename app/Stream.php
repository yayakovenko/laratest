<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stream
 *
 * @package App
 * @property int $id
 * @property int $stream_type
 * @property int $game_id
 * @property string $user_id
 * @property int $stream_id
 * @property int $viewer_count
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereStreamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereStreamType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Stream whereViewerCount($value)
 * @mixin \Eloquent
 */
class Stream extends Model
{
    const STREAM_TWITCH = 1;
    const STREAM_YOUTUBE = 2;
}
