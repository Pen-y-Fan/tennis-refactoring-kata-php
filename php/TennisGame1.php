<?php
declare(strict_types=1);

class TennisGame1 implements TennisGame
{
    private $player1Score = 0;
    private $player2Score = 0;
    private $player1Name;
    private $player2Name;
    private $currentScore = ["Love", "Fifteen", "Thirty", "Forty"];

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint(string $playerName)
    {
        $this->player1Name === $playerName ? $this->player1Score++ : $this->player2Score++;
    }

    public function getScore(): string
    {
        if ($this->isPlayerScoreEqual()) {
            return $this->playOnDeuceOrAll();
        }
        if ($this->isPlayOnWinOrAdvantage()) {
            return $this->playOnAdvantageOrWin();
        }
        return $this->currentScore[$this->player1Score] . "-" . $this->currentScore[$this->player2Score];
    }

    private function isPlayerScoreEqual(): bool
    {
        return $this->player1Score === $this->player2Score;
    }

    private function isPlayOnWinOrAdvantage(): bool
    {
        return $this->player1Score >= 4 || $this->player2Score >= 4;
    }

    /**
     * @return string
     */
    protected function playOnAdvantageOrWin(): string
    {
        $difference = $this->player1Score - $this->player2Score;
        if (abs($difference) == 1) {
            return $difference > 0 ? "Advantage {$this->player1Name}" : "Advantage {$this->player2Name}";
        }
        return $difference > 1 ? "Win for " . $this->player1Name : "Win for " . $this->player2Name;
    }

    /**
     * @return string
     */
    protected function playOnDeuceOrAll(): string
    {
        return ($this->player1Score > 2) ? "Deuce" : $this->currentScore[$this->player1Score] . "-All";
    }
}

