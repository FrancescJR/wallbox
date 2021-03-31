<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\Shared\Service;


use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;
use Kata\Domain\Shared\Service\DeployVehicleInCityService;
use Kata\Domain\Shared\Service\EVCityPositionAllowedService;
use Kata\Stubs\Domain\City\CityStub;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPositionStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirectionStub;
use PHPUnit\Framework\TestCase;

class DeployVehicleInCityServiceTest extends TestCase
{
    private $city;

    private $service;

    public function setUp():void
    {
        $this->city = CityStub::create(20,20);
        $checkerService = self::createMock(EVCityPositionAllowedService::class);
        $deployService = new DeployVehicleInCityService($checkerService);
        $this->service =  $deployService;
    }

    public function testDeploy(): void
    {

        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,10),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );
        $this->service->execute($ev, $this->city);

        self::assertCount(1, $this->city->getVehicles());

        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(5,10),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );
        $this->service->execute($ev, $this->city);

        self::assertCount(2, $this->city->getVehicles());


        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,5),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );
        $this->service->execute($ev, $this->city);

        self::assertCount(3, $this->city->getVehicles());


        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(2,2),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );
        $this->service->execute($ev, $this->city);

        self::assertCount(4, $this->city->getVehicles());
    }

    public function testOccupiedPosition(): void
    {
        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,10),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );

        $this->service->execute($ev, $this->city);

        $ev2 = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,10),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );

        self::expectException(PositionAlreadyInUseException::class);

        $this->service->execute($ev2, $this->city);

    }

}