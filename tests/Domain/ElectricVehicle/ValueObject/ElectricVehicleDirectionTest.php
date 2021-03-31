<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\ElectricVehicle\ValueObject;


use Kata\Domain\ElectricVehicle\Exception\InvalidElectricVehicleDirectionException;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;
use PHPUnit\Framework\TestCase;

class ElectricVehicleDirectionTest extends TestCase
{
    public function testConstruct(): void
    {
        $direction = ElectricVehicleDirection::DIRECTIONS_ALLOWED[
            rand(0, count(ElectricVehicleDirection::DIRECTIONS_ALLOWED)-1)
        ];

        $evDirection = new ElectricVehicleDirection($direction);

        self::assertEquals($direction, $evDirection->value());
    }

    public function testWrongValue(): void
    {
        $direction = "wrong direction";

        self::expectException(InvalidElectricVehicleDirectionException::class);

        new ElectricVehicleDirection($direction);
    }

}