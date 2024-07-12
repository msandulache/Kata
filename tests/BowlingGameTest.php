<?php

namespace App;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class BowlingGameTest extends TestCase
{
    protected BowlingGame $game;

    public function setUp(): void
    {
        $this->game = new BowlingGame();
    }

    #[Test]
    public function test_one_roll()
    {
        $this->game->roll(1);

        $this->assertEquals(1, $this->game->score());
    }

    #[Test]
    public function test_no_pins__knocked()
    {
        $this->game->roll(0);

        $this->assertEquals(0, $this->game->score());
    }

    #[Test]
    public function test_an_invalid_roll()
    {
        $this->expectExceptionMessage('Invalid Number of Pins Knocked Down');
        $this->game->roll(100);
    }

    #[Test]
    public function test_multiple_rolls()
    {
        $this->game->roll(1);
        $this->game->roll(2);
        $this->game->roll(3);

        $this->assertEquals(6, $this->game->score());
    }

    #[Test]
    public function test_a_spare()
    {
        $this->game->roll(1);
        $this->game->roll(1);

        $this->game->roll(4);
        $this->game->roll(6);

        $this->game->roll(1);

        $this->assertEquals(14, $this->game->score());
    }

    #[Test]
    public function test_a_strike_scenario_1()
    {
        $this->game->roll(2);
        $this->game->roll(2);

        $this->game->roll(10);
        $this->game->roll(0);

        $this->game->roll(1);
        $this->game->roll(2);

        $this->assertEquals(20, $this->game->score());
    }

    #[Test]
    public function test_a_strike_scenario_2()
    {
        $this->game->roll(9);
        $this->game->roll(0);

        $this->game->roll(0);
        $this->game->roll(10);

        $this->game->roll(1);
        $this->game->roll(1);

        $this->assertEquals(23, $this->game->score());
    }

    #[Test]
    public function test_no_more_rolls_left()
    {
        for ($i = 1; $i <= (2 * BowlingGame::FRAMES) + 1; $i++) {
            $this->expectExceptionMessage('End of game. No more rolls left');
            $this->game->roll(1);
        }
    }

    #[Test]
    public function test_a_spare_in_the_last_frame()
    {
        for ($i = 1; $i <= ((2 * BowlingGame::FRAMES) - 2); $i++) {
            $this->game->roll(1);
        }

        $this->game->roll(4);
        $this->game->roll(6);

        $this->game->roll(1);

        $this->assertEquals(30, $this->game->score());
    }

    #[Test]
    public function test_a_strike_in_the_last_frame_scenario_1()
    {
        for ($i = 1; $i <= ((2 * BowlingGame::FRAMES) - 2); $i++) {
            $this->game->roll(1);
        }

        $this->game->roll(10);
        $this->game->roll(0);

        $this->game->roll(1);
        $this->game->roll(1);

        $this->assertEquals(32, $this->game->score());
    }

    #[Test]
    public function test_a_strike_in_the_last_frame_scenario_2()
    {
        for ($i = 1; $i <= ((2 * BowlingGame::FRAMES) - 2); $i++) {
            $this->game->roll(1);
        }

        $this->game->roll(0);
        $this->game->roll(10);

        $this->game->roll(2);
        $this->game->roll(2);

        $this->assertEquals(36, $this->game->score());
    }
}
