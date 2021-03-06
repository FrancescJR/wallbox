<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\Shared\Service;


use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;
use Kata\Domain\Shared\Service\EVCityPositionAllowedService;
use Kata\Domain\Shared\Service\MoveVehicleInCityService;
use Kata\Stubs\Domain\City\CityStub;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPositionStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirectionStub;
use PHPUnit\Framework\TestCase;

class MoveVehicleInCityServiceTest extends TestCase
{
    private $city;

    private $service;

    public function setUp():void
    {
        $this->city = CityStub::create(20,20);
        $checkerService = self::createMock(EVCityPositionAllowedService::class);
        $moveVehicleInCityService = new MoveVehicleInCityService($checkerService);
        $this->service =  $moveVehicleInCityService;
    }

    public function testMove(): void
    {

        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,10),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );

        $this->city->addVehicle($ev);

        $this->service->execute($ev, $this->city);

        self::assertEquals(11, $ev->getCityPosition()->getPositionY());
        self::assertEquals(10, $ev->getCityPosition()->getPositionX());
        self::assertEquals(ElectricVehicleDirection::NORTH, $ev->getDirection()->value());
    }

    public function testOccupiedPosition(): void
    {
        $ev = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,10),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );

        $this->city->addVehicle($ev);

        $ev2 = ElectricVehicleStub::create(
            ElectricVehicleCityPositionStub::create(10,9),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );

        $this->city->addVehicle($ev2);

        self::expectException(PositionAlreadyInUseException::class);

        $this->service->execute($ev2, $this->city);

    }


}