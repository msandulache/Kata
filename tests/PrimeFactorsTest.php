<?php


use App\PrimeFactors;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class PrimeFactorsTest extends TestCase
{
    #[DataProvider('provideData')] #[Test]
    public function generate_prime_number($input, $expectedResult)
    {
        $primeFactors = new PrimeFactors();

        $this->assertEquals($expectedResult, $primeFactors->generate($input));
    }

    public static function provideData()
    {
        return [
            [1, []],
            [2, [2]],
            [3, [3]],
            [4, [2, 2]],
            [5, [5]],
            [6, [2, 3]],
            [7, [7]],
            [8, [2, 2, 2]],
            [100, [2, 2, 5, 5]],
        ];
    }

}
