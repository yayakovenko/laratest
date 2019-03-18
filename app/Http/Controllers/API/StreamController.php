<?php

namespace App\Http\Controllers\API;

use App\Stream;
use App\StreamStat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class StreamController
 * @package App\Http\Controllers\API
 */
class StreamController extends Controller
{
    /**
     * @param $game_ids
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @todo Cache::get('key');
     */
    public function getStreams($game_ids, Request $request)
    {
        $game_ids = array_map('trim', explode(',', $game_ids));
        if (empty($game_ids)) {
            response()->json(['data' => []], 401);
        }

        $out = array_fill_keys($game_ids, []);

        $result = Stream::where([
            'created_at' => $this->getPeriod($request),
            'game_id' => $game_ids
        ])->get();

        if ($result) {
            foreach ($result as $stream) {
                $out[$stream->game_id][] = $stream->toArray();
            }
        }

        return response()->json(['data' => $out], 200);
    }

    /**
     * @param $game_ids
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * @todo Cache::get('key');
     */
    public function getViewers($game_ids, Request $request)
    {
        $game_ids = array_map('trim', explode(',', $game_ids));
        if (empty($game_ids)) {
            response()->json(['data' => []], 401);
        }

        $out = array_fill_keys($game_ids, 0);

        $result = StreamStat::where([
            'created_at' => $this->getPeriod($request),
            'game_id' => $game_ids
        ])->get();

        if ($result) {
            foreach ($result as $stream) {
                $out[$stream->game_id] = $stream->viewer_count;
            }
        }

        return response()->json(['data' => $out], 200);
    }

    /**
     * @param Request $request
     * @return Carbon
     */
    private function getPeriod(Request $request)
    {
        $str = $request->get('period', null);
        $date = date('Y-m-d H:i:00');
        if ($str) {
            $new_ts = strtotime($str);
            if ($new_ts) {
                $date = date('Y-m-d H:i:00', $new_ts);
            }
        }

        return StreamStat::where([
            ['created_at', '<=', $date]
        ])
            ->limit('1')
            ->orderBy('created_at', 'desc')
            ->pluck('created_at')
            ->first();
    }
}