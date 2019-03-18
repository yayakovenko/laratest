<?php
namespace App\Tools\StreamServices;

interface StreamServiceInterface {
    public function getStreams(array $game_ids, string $date);
}