<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class StreamStat
 *
 * @package App
 * @property int $id
 * @property int $stream_type
 * @property int $game_id
 * @property int $viewer_count
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat whereGameId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat where($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat whereStreamType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\StreamStat whereViewerCount($value)
 */
class StreamStat extends Model
{
    //
}
