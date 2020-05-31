<?php

declare(strict_types=1);

namespace TennisGame;

final class TennisGame1 implements TennisGame
{
    /**
     * @var array
     */
    private const CURRENT_SCORE = ['Love', 'Fifteen', 'Thirty', 'Forty'];

    /**
     * @var int
     */
    private $player1Score = 0;

    /**
     * @var int
     */
    private $player2Score = 0;

    /**
     * @var string
     */
    private $player1Name;

    /**
     * @var string
     */
    private $player2Name;

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint(string $playerName): void
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
        return self::CURRENT_SCORE[$this->player1Score] . '-' . self::CURRENT_SCORE[$this->player2Score];
    }

    private function playOnAdvantageOrWin(): string
    {
        $difference = $this->player1Score - $this->player2Score;
        if (abs($difference) === 1) {
            return $difference > 0 ? "Advantage {$this->player1Name}" : "Advantage {$this->player2Name}";
        }
        return $difference > 1 ? 'Win for ' . $this->player1Name : 'Win for ' . $this->player2Name;
    }

    private function playOnDeuceOrAll(): string
    {
        return $this->player1Score > 2 ? 'Deuce' : self::CURRENT_SCORE[$this->player1Score] . '-All';
    }

    private function isPlayerScoreEqual(): bool
    {
        return $this->player1Score === $this->player2Score;
    }

    private function isPlayOnWinOrAdvantage(): bool
    {
        return $this->player1Score >= 4 || $this->player2Score >= 4;
    }
}
