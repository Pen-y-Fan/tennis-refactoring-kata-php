<?php

declare(strict_types=1);

namespace Tests;

use TennisGame\TennisGame3;

/**
 * TennisGame3 test case.
 */
final class TennisGame3Test extends TestMaster
{
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->game = new TennisGame3('player1', 'player2');
    }

    /**
     * @dataProvider data
     */
    public function testScores(int $score1, int $score2, string $expectedResult): void
    {
        $this->seedScores($score1, $score2);
        $this->assertSame($expectedResult, $this->game->getScore(), "Score: Player1 {$score1} vs player2 {$score2}");
    }
}
