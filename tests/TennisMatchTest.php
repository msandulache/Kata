<?php


use App\TennisMatch;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class TennisMatchTest extends TestCase
{
    protected TennisMatch $match;

    public function setUp(): void
    {
        $this->match = new TennisMatch("Andy", "Bob");
    }

    #[DataProvider('providers')] #[Test]
    public function test_match($player1Points, $player2Points, $result)
    {
        $this->match->play();

        for ($i = 1; $i <= $player1Points; $i++) {
            $this->match->player1Scores();
        }

        for ($i = 1; $i <= $player2Points; $i++) {
            $this->match->player2Scores();
        }

        $this->assertEquals($result, $this->match->score());
    }

    public static function providers(): array
    {
        return [
            [0,0,'love - love'],
            [1,0,'fifteen - love'],
            [2,0,'thirty - love'],
            [3,2,'forty - thirty'],
            [4,0,'Andy won'],
            [0,1,'love - fifteen'],
            [0,2,'love - thirty'],
            [1,3,'fifteen - forty'],
            [0,4,'Bob won'],
            [3,3,'deuce'],
            [5,4,'Andy has advantage'],
            [5,7,'Bob won'],
            [5,6,'Bob has advantage'],
            [2,2,'thirty - thirty'],
            [5,5,'deuce'],
        ];
    }
}
