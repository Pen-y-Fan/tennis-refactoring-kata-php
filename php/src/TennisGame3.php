<?php

declare(strict_types=1);

namespace TennisGame;

final class TennisGame3 implements TennisGame
{
    /**
     * @var string[]
     */
    private const P = ['Love', 'Fifteen', 'Thirty', 'Forty'];

    /**
     * @var int
     */
    private $p2 = 0;

    /**
     * @var int
     */
    private $p1 = 0;

    /**
     * @var string
     */
    private $p1N = '';

    /**
     * @var string
     */
    private $p2N = '';

    public function __construct(string $p1N, string $p2N)
    {
        $this->p1N = $p1N;
        $this->p2N = $p2N;
    }

    public function getScore(): string
    {
        if ($this->p1 < 4 && $this->p2 < 4 && ! ($this->p1 + $this->p2 === 6)) {
            $s = self::P[$this->p1];
            return $this->p1 === $this->p2 ? $s . '-All' : $s . '-' . self::P[$this->p2];
        }
        if ($this->p1 === $this->p2) {
            return 'Deuce';
        }
        $s = $this->p1 > $this->p2 ? $this->p1N : $this->p2N;
        return ($this->p1 - $this->p2) * ($this->p1 - $this->p2) === 1 ? "Advantage {$s}" : "Win for {$s}";
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === 'player1') {
            $this->p1++;
        } else {
            $this->p2++;
        }
    }
}
