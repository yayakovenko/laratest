<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stream_stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('stream_type');
            $table->bigInteger('game_id');
            $table->integer('viewer_count');
            $table->dateTime('created_at');

            $table->index('created_at');
            $table->index('game_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stream_stats');
    }
}
