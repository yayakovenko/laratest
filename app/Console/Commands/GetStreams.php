<?php

namespace App\Console\Commands;

use App\Facades\Twitch;
use App\Game;
use Illuminate\Console\Command;

class GetStreams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:get-streams';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get and save streams list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $date = date('Y-m-d H:i:00');
        $game_ids = Game::where('status', true)->pluck('game_id')->toArray();

        Twitch::getStreams($game_ids, $date);
        Twitch::aggregate($date);

        //Youtube::getStreams($game_ids, $date);
    }
}
