<?php

declare(strict_types=1);

namespace TennisGame;

final class TennisGame3 implements TennisGame
{
    /**
     * @var string[]
     */
    private const SCORE = ['Love', 'Fifteen', 'Thirty', 'Forty'];

    /**
     * @var int
     */
    private $player2Points = 0;

    /**
     * @var int
     */
    private $player1Points = 0;

    /**
     * @var Player
     */
    private $player1;

    /**
     * @var Player
     */
    private $player2;

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1 = new Player($player1Name);
        $this->player2 = new Player($player2Name);
    }

    public function getScore(): string
    {
        if ($this->isPlayerPointsEqual() && $this->isPlayerPointsMoreThanTwo()) {
            return 'Deuce';
        }

        if ($this->isPlayer1AndPlayer2PointsLessThanFour()) {
            return $this->isPlayerPointsEqual()
                ? self::SCORE[$this->player1Points] . '-All'
                : self::SCORE[$this->player1Points] . '-' . self::SCORE[$this->player2Points];
        }

        return $this->isPlayerAdvantage()
            ? 'Advantage ' . $this->getWinningPlayerName()
            : 'Win for ' . $this->getWinningPlayerName();
    }

    public function wonPoint(string $playerName): void
    {
        $this->isPlayerOne($playerName)
            ? $this->player1Points++
            : $this->player2Points++;
    }

    private function isPlayerPointsEqual(): bool
    {
        return $this->player1Points === $this->player2Points;
    }

    private function getWinningPlayerName(): string
    {
        return $this->isPlayerOneWinning()
            ? $this->player1->name()
            : $this->player2->name();
    }

    private function isPlayer1AndPlayer2PointsLessThanFour(): bool
    {
        return $this->player1Points < 4 && $this->player2Points < 4;
    }

    /**
     * Only works after other options are eliminated
     */
    private function isPlayerAdvantage(): bool
    {
        return abs($this->player1Points - $this->player2Points) === 1;
    }

    private function isPlayerPointsMoreThanTwo(): bool
    {
        return $this->player1Points > 2;
    }

    private function isPlayerOne(string $playerName): bool
    {
        return $playerName === $this->player1->name();
    }

    private function isPlayerOneWinning(): bool
    {
        return $this->player1Points > $this->player2Points;
    }
}
