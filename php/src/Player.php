<?php

declare(strict_types=1);

namespace TennisGame;

final class Player
{
    /**
     * @var string
     */
    private $name;

    /**
     * Player constructor.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
