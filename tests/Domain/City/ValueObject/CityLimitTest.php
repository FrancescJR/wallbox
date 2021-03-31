<?php


namespace Kata\Tests\Domain\City\ValueObject;


use Kata\Domain\City\Exception\InvalidCitySizeException;
use Kata\Domain\City\ValueObject\CityLimit;
use PHPUnit\Framework\TestCase;

class CityLimitTest extends TestCase
{
    public function testCreate(): void
    {
        $value = 5;
        $cityLimit = new CityLimit($value);
        self::assertEquals($value, $cityLimit->value());
    }

    public function testNegativeValue(): void
    {
        self::expectException(InvalidCitySizeException::class);
        new CityLimit(-10);
    }

}