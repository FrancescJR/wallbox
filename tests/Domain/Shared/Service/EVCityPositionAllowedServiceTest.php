<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\Shared\Service;


use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\Shared\Service\EVCityPositionAllowedService;
use Kata\Stubs\Domain\City\CityStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPositionStub;
use PHPUnit\Framework\TestCase;

class EVCityPositionAllowedServiceTest extends TestCase
{
    private $city;

    private $service;

    public function setUp():void
    {
        $this->city = CityStub::create(10,10);
        $this->service =  new EVCityPositionAllowedService();
    }

    public function testBiggerLimitX(): void
    {
        self::expectException(VehicleOutOfRangeException::class);

        $position = ElectricVehicleCityPositionStub::create(11, 10);

        $this->service->execute($position, $this->city);
    }

    public function testBiggerLimitY(): void
    {
        self::expectException(VehicleOutOfRangeException::class);

        $position = ElectricVehicleCityPositionStub::create(10, 11);

        $this->service->execute($position, $this->city);
    }

    public function testLowerLimitX(): void
    {
        self::expectException(VehicleOutOfRangeException::class);

        $position = ElectricVehicleCityPositionStub::create(-4, 10);

        $this->service->execute($position, $this->city);
    }

    public function testLowerLimitY(): void
    {
        self::expectException(VehicleOutOfRangeException::class);

        $position = ElectricVehicleCityPositionStub::create(4, -10);

        $this->service->execute($position, $this->city);
    }

}