<?php

namespace App;

class TennisMatch
{
    protected int $player1Points;
    protected int $player2Points;

    function __construct(
        protected string $player1Name,
        protected string $player2Name
    ) {

    }

    public function play()
    {
        $this->player1Points = 0;
        $this->player2Points = 0;
    }

    public function player1Scores()
    {
        $this->player1Points++;
    }

    public function player2Scores()
    {
        $this->player2Points++;
    }

    public function score(): string
    {
        if ($this->isDeuce()) {
            return 'deuce';
        }

        if ($this->hasPlayer1Advantage()) {
            return $this->printAdvantage($this->player1Name);
        }

        if ($this->hasPlayer2Advantage()) {
            return $this->printAdvantage($this->player2Name);
        }

        if ($this->isWinner()) {
            return $this->printWinner();
        }

        return $this->printScore();
    }

    private function printScore(): string
    {
        return sprintf(
            '%s - %s',
            $this->pointsToScore($this->player1Points),
            $this->pointsToScore($this->player2Points));
    }

    private function pointsToScore(int $points): string
    {
        if ($points == 3) {
            return 'forty';
        }

        if ($points == 2) {
            return 'thirty';
        }

        if ($points == 1) {
            return 'fifteen';
        }

        if ($points == 0) {
            return 'love';
        }

        return '';
    }

    private function isDeuce(): bool
    {
        return ($this->player1Points == $this->player2Points) && ($this->player1Points >= 3);
    }

    private function isWinner(): bool
    {
        return ($this->player1Points >= 4) && ($this->player1Points - $this->player2Points >= 2) ||
            ($this->player2Points >= 4) && ($this->player2Points - $this->player1Points >= 2);
    }


    private function hasPlayer1Advantage(): bool
    {
        return ($this->player1Points - $this->player2Points == 1) && ($this->player1Points >= 4);
    }

    private function hasPlayer2Advantage(): bool
    {
        return ($this->player2Points - $this->player1Points == 1) && ($this->player2Points >= 4);
    }

    private function printWinner(): string
    {
        if ($this->player1Points > $this->player2Points) {
            return sprintf('%s won', $this->player1Name);
        } else {
            return sprintf('%s won', $this->player2Name);
        }
    }

    private function printAdvantage($playerName): string
    {
        return sprintf('%s has advantage', $playerName);
    }
}
