<?php


use App\StringCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    protected StringCalculator $calculator;

    public function setUp(): void
    {
        $this->calculator = new StringCalculator();
    }

    #[DataProvider("providers")] #[Test]
    public function test_empty_string($numbers, $expectedSum)
    {
        $sum = $this->calculator->add($numbers);

        $this->assertEquals($expectedSum, $sum);
    }

    #[Test]
    public function test_string_with_negative_number()
    {
        $this->expectExceptionMessage("Negatives not allowed");

        $sum = $this->calculator->add("0,-1,1");
    }

    public static function providers()
    {
        return [
            ["", 0],
            ["1", 1],
            ["1, 2", 3],
            ["1, 2, 3", 6],
            ["1\n2,3", 6],
            ["2,1001", 2],
            ["//:\n2:10", 12],
            ["//:\n4:4:2", 10]
        ];
    }
}
