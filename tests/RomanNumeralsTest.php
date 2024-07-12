<?php

namespace App;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RomanNumeralsTest extends TestCase
{
    protected RomanNumerals $romanNumerals;

    public function setUp(): void
    {
        $this->romanNumerals = new RomanNumerals();
    }

    #[DataProvider('provideData')] #[Test]
    public function it_generates_the_roman_numerals_for_1($inputNumber, $expectedRoman): void
    {
        $this->assertEquals($expectedRoman, $this->romanNumerals->generate($inputNumber));
    }

    #[Test]
    public function it_cannot_generate_the_roman_numerals_for_less_than_1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->romanNumerals->generate(-4);
    }

    #[Test]
    public function it_cannot_generate_the_roman_numerals_for_more_than_3999()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->romanNumerals->generate(10000);
    }

    public static function provideData()
    {
        return [
            [1, 'I'],
            [2, 'II'],
            [3, 'III'],
            [4, 'IV'],
            [5, 'V'],
            [6, 'VI'],
            [7, 'VII'],
            [8, 'VIII'],
            [9, 'IX'],
            [10, 'X'],
            [14, 'XIV'],
            [15, 'XV'],
            [20, 'XX'],
            [40, 'XL'],
            [50, 'L'],
            [63, 'LXIII'],
            [93, 'XCIII'],
            [150, 'CL'],
            [450, 'CDL'],
            [950, 'CML'],
        ];
    }
}
