<?php
namespace App\Tools\StreamServices;

use App\Stream;
use App\StreamStat;
use Illuminate\Support\Facades\DB;

class Twitch implements StreamServiceInterface
{
    private $twitch = null;
    public function __construct(\romanzipp\Twitch\Twitch $twitch)
    {
        $this->twitch = $twitch;
    }

    /**
     * Собирает списки трансляций для игр и сохраняет в БД
     *
     * @param array $game_ids - массив игр
     * @param string $date Y-m-d H:i:00 - текущая дата
     *
     * @return void
     */
    public function getStreams(array $game_ids, string $date) {
        $chunks = array_chunk($game_ids, env('TWITCH_MAX_CHUNK', 100));

        foreach ($chunks as $chunk) {
            $insert = [];
            do {
                $result = $this->twitch->getStreams(['first' => 100, 'game_id' => $chunk], isset($result) ? $result->next() : null);

                foreach ($result->data as $item) {
                    $insert[] = [
                        'stream_type' => Stream::STREAM_TWITCH,
                        'stream_id' => $item->id,
                        'user_id' => $item->user_id,
                        'game_id' => $item->game_id,
                        'viewer_count' => $item->viewer_count,
                        'created_at' => $date
                    ];
                }

            } while ($result->count() > 0);

            Stream::insert($insert);
        }
    }

    /**
     * Суммирует количество просмотров за конкретный период
     *
     * @param string $date Y-m-d H:i:00 - текущая дата
     */
    public function aggregate(string $date) {
        $select = Stream::where([
                'created_at' => $date,
                'stream_type' => Stream::STREAM_TWITCH
            ])
            ->select([
                'stream_type',
                'game_id',
                'created_at',
                DB::raw("SUM(viewer_count) as count"),
            ])
            ->groupBy(['stream_type', 'game_id', 'created_at']);
        ;

        $bindings = $select->getBindings();
        $insertQuery = 'INSERT into '.(new StreamStat)->getTable().' (stream_type, game_id, created_at, viewer_count) '
            . $select->toSql();

        DB::insert($insertQuery, $bindings);
    }
}