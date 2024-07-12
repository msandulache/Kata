<?php

namespace App;

class PrimeFactors
{
    public function generate(int $number): array
    {
        $factors = [];

        for($divisor = 2; $number > 1; $divisor++) {
            while($number % $divisor == 0) {
                $factors[] = $divisor;
                $number = $number / $divisor;
            }
        }

        return $factors;
    }
}
