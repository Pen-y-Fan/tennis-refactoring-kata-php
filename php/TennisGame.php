<?php
declare(strict_types=1);

interface TennisGame
{
    /**
     * @param  $playerName
     * @return void
     */
    public function wonPoint(string $playerName);

    /**
     * @return string
     */
    public function getScore();
}
