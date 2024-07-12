<?php

namespace App;

class StringCalculator
{
    const LIMIT = 1000;

    public function add(string $numbers)
    {
        $delimitator = ",|\n";

        if(preg_match("/\/\/(.)\n/", $numbers, $matches)) {
            if(isset($matches[1])) {
                $delimitator = $matches[1];
            }

            $numbers = str_replace($matches[0], '', $numbers);
        }

        $arrayOfNumbers = preg_split("/{$delimitator}/", $numbers);

        $sum = 0;
        foreach ($arrayOfNumbers as $number) {
            if((int)$number < 0) {
                throw new \Exception('Negatives not allowed');
            } elseif((int) $number < self::LIMIT) {
                $sum += (int) $number;
            }
        }

        return $sum;
    }
}
