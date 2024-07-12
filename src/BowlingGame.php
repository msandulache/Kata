<?php

namespace App;

class BowlingGame
{
    const TOTAL_PINS = 10;
    const FRAMES = 10;

    protected array $rolls = [];
    protected int $maxNumberOfRolls;

    function __construct()
    {
        $this->rolls = [];
        $this->maxNumberOfRolls = 2 * self::FRAMES;
    }

    public function roll(int $pins): void
    {
        if ($pins < 0 || $pins > self::TOTAL_PINS) {
            throw new \InvalidArgumentException('Invalid Number of Pins Knocked Down');
        }

        $currentRollIndex = count($this->rolls) - 1;

        if ($this->isSpare($currentRollIndex) && $this->isInLastFrame($currentRollIndex)) {
            $this->maxNumberOfRolls += 1;
        }

        if ($this->isStrike($currentRollIndex) && $this->isInLastFrame($currentRollIndex)) {
            $this->maxNumberOfRolls += 2;
        }

        if (count($this->rolls) >= $this->maxNumberOfRolls) {
            throw new \InvalidArgumentException('End of game. No more rolls left');
        }

        $this->rolls[] = $pins;
    }

    public function score(): int
    {
        $score = 0;
        foreach ($this->rolls as $rollIndex => $scorePerRoll) {
            $score += $scorePerRoll;

            if ($this->isSpare($rollIndex)) {
                $score += $this->rolls[$rollIndex + 1] ?? 0;
            }

            if ($this->isStrike($rollIndex)) {
                $score += $this->rolls[$rollIndex + 1] ?? 0;
                $score += $this->rolls[$rollIndex + 2] ?? 0;
            }
        }

        return $score;
    }

    private function isStrike($rollIndex): bool
    {
        if (
            isset($this->rolls[$rollIndex - 1]) &&
            (
                $this->rolls[$rollIndex] == self::TOTAL_PINS ||
                $this->rolls[$rollIndex] == 0
            ) &&
            ($this->rolls[$rollIndex - 1] + $this->rolls[$rollIndex] == self::TOTAL_PINS)
        ) {
            return true;
        }

        return false;
    }

    private function isSpare($rollIndex): bool
    {
        if (
            isset($this->rolls[$rollIndex - 1]) &&
            (
                $this->rolls[$rollIndex] < self::TOTAL_PINS &&
                $this->rolls[$rollIndex] > 0
            ) &&
            ($this->rolls[$rollIndex - 1] + $this->rolls[$rollIndex] == self::TOTAL_PINS)
        ) {
            return true;
        }

        return false;
    }

    private function isInLastFrame($rollIndex): bool
    {
        if ($rollIndex < $this->maxNumberOfRolls - 2) {
            return false;
        }

        return true;
    }
}
