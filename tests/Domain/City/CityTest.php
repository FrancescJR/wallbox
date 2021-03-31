<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\City;


use Kata\Domain\City\City;
use Kata\Stubs\Domain\City\ValueObject\CityLimitStub;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    public function testGetters(): void
    {
        $cityLimitX = CityLimitStub::random();
        $cityLimitY = CityLimitStub::random();

        $city = new City(
            $cityLimitX,
            $cityLimitY
        );

        self::assertEquals($cityLimitX->value(), $city->getLimitX()->value());
        self::assertEquals($cityLimitY->value(), $city->getLimitY()->value());
    }

    public function testAddVehicles(): void
    {
        $city = new City(
            CityLimitStub::random(),
            CityLimitStub::random()
        );

        self::assertCount(0, $city->getVehicles());

        $electricVehicle = ElectricVehicleStub::random();

        $city->addVehicle($electricVehicle);

        self::assertCount(1, $city->getVehicles());

        $electricVehicle2 = ElectricVehicleStub::random();

        $city->addVehicle($electricVehicle2);

        self::assertCount(2, $city->getVehicles());

        self::assertEquals([$electricVehicle, $electricVehicle2], $city->getVehicles());

    }

}