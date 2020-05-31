<?php

declare(strict_types=1);

namespace TennisGame;

final class TennisGame2 implements TennisGame
{
    private const ALL = '-All';

    private const LOVE = 'Love';

    private const FIFTEEN = 'Fifteen';

    private const THIRTY = 'Thirty';

    private const FORTY = 'Forty';

    /**
     * @var int
     */
    private $P1point = 0;

    /**
     * @var int
     */
    private $P2point = 0;

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

    public function wonPoint(string $player): void
    {
        $player === $this->player1->name() ? $this->increasePlayer1Score() : $this->increasePlayer2Score();
    }

    public function getScore(): string
    {
        if ($this->hasPlayer1Won()) {
            return 'Win for ' . $this->player1->name();
        }

        if ($this->hasPlayer2Won()) {
            return 'Win for ' . $this->player2->name();
        }
        if ($this->hasPlayer1Advantage()) {
            return 'Advantage ' . $this->player1->name();
        }

        if ($this->hasPlayer2Advantage()) {
            return 'Advantage ' . $this->player2->name();
        }
        if ($this->isScoreEqual()) {
            return $this->getEqualScore();
        }

        if ($this->isPlayer1Love()) {
            return $this->getLovePlayer2Score();
        }

        if ($this->isPlayer2Love()) {
            return $this->getPlayer1ScoreLove();
        }

        if ($this->isPlayer1Leading()) {
            return $this->getPlayer1LeadingScore();
        }

        return $this->getPlayer2LeadingScore();
    }

    private function increasePlayer1Score(): void
    {
        $this->P1point++;
    }

    private function increasePlayer2Score(): void
    {
        $this->P2point++;
    }

    private function isScoreEqual(): bool
    {
        return $this->P1point === $this->P2point;
    }

    private function hasPlayer1Won(): bool
    {
        return $this->P1point >= 4 && $this->P2point >= 0 && ($this->P1point - $this->P2point) >= 2;
    }

    private function hasPlayer2Won(): bool
    {
        return $this->P2point >= 4 && $this->P1point >= 0 && ($this->P2point - $this->P1point) >= 2;
    }

    private function hasPlayer1Advantage(): bool
    {
        return $this->P1point > $this->P2point && $this->P2point >= 3;
    }

    private function hasPlayer2Advantage(): bool
    {
        return $this->P2point > $this->P1point && $this->P1point >= 3;
    }

    private function isPlayer1Love(): bool
    {
        return $this->P1point === 0;
    }

    private function isPlayer2Love(): bool
    {
        return $this->P2point === 0;
    }

    private function isPlayer1Leading(): bool
    {
        return $this->P1point > $this->P2point;
    }

    private function getEqualScore(): string
    {
        if ($this->P1point === 0) {
            return self::LOVE . self::ALL;
        }
        if ($this->P1point === 1) {
            return self::FIFTEEN . self::ALL;
        }
        if ($this->P1point === 2) {
            return self::THIRTY . self::ALL;
        }
        return 'Deuce';
    }

    private function getLovePlayer2Score(): string
    {
        if ($this->P2point === 1) {
            return self::LOVE . '-' . self::FIFTEEN;
        }
        if ($this->P2point === 2) {
            return self::LOVE . '-' . self::THIRTY;
        }
        return self::LOVE . '-' . self::FORTY;
    }

    private function getPlayer1ScoreLove(): string
    {
        if ($this->P1point === 1) {
            return self::FIFTEEN . '-' . self::LOVE;
        }
        if ($this->P1point === 2) {
            return self::THIRTY . '-' . self::LOVE;
        }
        return self::FORTY . '-' . self::LOVE;
    }

    private function getPlayer1LeadingScore(string $player1Score = ''): string
    {
        if ($this->P1point === 2) {
            $player1Score = self::THIRTY;
        }
        if ($this->P1point === 3) {
            $player1Score = self::FORTY;
        }
        if ($this->P2point === 1) {
            return $player1Score . '-' . self::FIFTEEN;
        }
        return $player1Score . '-' . self::THIRTY;
    }

    private function getPlayer2LeadingScore(string $player2score = ''): string
    {
        if ($this->P2point === 2) {
            $player2score = self::THIRTY;
        }
        if ($this->P2point === 3) {
            $player2score = self::FORTY;
        }
        if ($this->P1point === 1) {
            return self::FIFTEEN . '-' . $player2score;
        }
        return self::THIRTY . '-' . $player2score;
    }
}
