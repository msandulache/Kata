<?php

namespace App;

use http\Exception\InvalidArgumentException;

class RomanNumerals
{
    public function generate($inputNumber): string
    {
        $romanNumerals = '';

        $romanNumeralsMap = [
            1000 => 'M',
            900 => 'CM',
            500 => 'D',
            400 => 'CD',
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I',
        ];

        if($inputNumber <= 0 || $inputNumber >= 4000) {
            throw new \InvalidArgumentException();
        }

        foreach ($romanNumeralsMap as $number => $romanLetter) {
            while ($inputNumber - $number >= 0) {
                $romanNumerals .= $romanLetter;
                $inputNumber = $inputNumber - $number;
            }
        }

        return $romanNumerals;
    }
}
