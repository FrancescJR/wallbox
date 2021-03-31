<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\ElectricVehicle\ValueObject;


use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;
use PHPUnit\Framework\TestCase;

class ElectricVehicleCityPositionTest extends TestCase
{
    public function testCreate(): void
    {
        $positionX = rand(0,50);
        $positionY = rand(0,50);
        $cityPosition = new ElectricVehicleCityPosition(
            $positionX,
            $positionY
        );

        self::assertEquals($positionX, $cityPosition->getPositionX());
        self::assertEquals($positionY, $cityPosition->getPositionY());
    }

}