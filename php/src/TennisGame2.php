<?php

declare(strict_types=1);

namespace TennisGame;

final class TennisGame2 implements TennisGame
{
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
     * @var string
     */
    private $P1res = '';

    /**
     * @var string
     */
    private $P2res = '';

    /**
     * @var string
     */
    private $player1Name = '';

    /**
     * @var string
     */
    private $player2Name = '';

    public function __construct(string $player1Name, string $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->P1point === $this->P2point && $this->P1point < 4) {
            if ($this->P1point === 0) {
                $score = self::LOVE;
            }
            if ($this->P1point === 1) {
                $score = self::FIFTEEN;
            }
            if ($this->P1point === 2) {
                $score = self::THIRTY;
            }
            $score .= '-All';
        }

        if ($this->P1point === $this->P2point && $this->P1point >= 3) {
            $score = 'Deuce';
        }

        if ($this->P1point > 0 && $this->P2point === 0) {
            if ($this->P1point === 1) {
                $this->P1res = self::FIFTEEN;
            }
            if ($this->P1point === 2) {
                $this->P1res = self::THIRTY;
            }
            if ($this->P1point === 3) {
                $this->P1res = self::FORTY;
            }

            $this->P2res = self::LOVE;
            $score = "{$this->P1res}-{$this->P2res}";
        }

        if ($this->P2point > 0 && $this->P1point === 0) {
            if ($this->P2point === 1) {
                $this->P2res = self::FIFTEEN;
            }
            if ($this->P2point === 2) {
                $this->P2res = self::THIRTY;
            }
            if ($this->P2point === 3) {
                $this->P2res = self::FORTY;
            }
            $this->P1res = self::LOVE;
            $score = "{$this->P1res}-{$this->P2res}";
        }

        if ($this->P1point > $this->P2point && $this->P1point < 4) {
            if ($this->P1point === 2) {
                $this->P1res = self::THIRTY;
            }
            if ($this->P1point === 3) {
                $this->P1res = self::FORTY;
            }
            if ($this->P2point === 1) {
                $this->P2res = self::FIFTEEN;
            }
            if ($this->P2point === 2) {
                $this->P2res = self::THIRTY;
            }
            $score = "{$this->P1res}-{$this->P2res}";
        }

        if ($this->P2point > $this->P1point && $this->P2point < 4) {
            if ($this->P2point === 2) {
                $this->P2res = self::THIRTY;
            }
            if ($this->P2point === 3) {
                $this->P2res = self::FORTY;
            }
            if ($this->P1point === 1) {
                $this->P1res = self::FIFTEEN;
            }
            if ($this->P1point === 2) {
                $this->P1res = self::THIRTY;
            }
            $score = "{$this->P1res}-{$this->P2res}";
        }

        if ($this->P1point > $this->P2point && $this->P2point >= 3) {
            $score = 'Advantage ' . $this->player1Name;
        }

        if ($this->P2point > $this->P1point && $this->P1point >= 3) {
            $score = 'Advantage ' . $this->player2Name;
        }

        if ($this->P1point >= 4 && $this->P2point >= 0 && ($this->P1point - $this->P2point) >= 2) {
            $score = 'Win for ' . $this->player1Name;
        }

        if ($this->P2point >= 4 && $this->P1point >= 0 && ($this->P2point - $this->P1point) >= 2) {
            $score = 'Win for ' . $this->player2Name;
        }

        return $score;
    }

    public function wonPoint(string $player): void
    {
        if ($player === $this->player1Name) {
            $this->P1Score();
        } else {
            $this->P2Score();
        }
    }

    private function P1Score(): void
    {
        $this->P1point++;
    }

    private function P2Score(): void
    {
        $this->P2point++;
    }
}
