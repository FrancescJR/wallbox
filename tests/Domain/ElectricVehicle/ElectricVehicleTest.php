<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\ElectricVehicle;


use Kata\Domain\ElectricVehicle\ElectricVehicle;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPositionStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirectionStub;
use PHPUnit\Framework\TestCase;

class ElectricVehicleTest extends TestCase
{
    public function testGetters(): void
    {
        $cityPosition = ElectricVehicleCityPositionStub::random();
        $direction = ElectricVehicleDirectionStub::random();

        $electricVehicle = new ElectricVehicle($cityPosition, $direction);

        self::assertEquals($cityPosition, $electricVehicle->getCityPosition());
        self::assertEquals($direction, $electricVehicle->getDirection());
    }

    public function testSetPosition(): void
    {
        $newPosition = ElectricVehicleCityPositionStub::random();
        $electricVehicle = ElectricVehicleStub::random();

        $electricVehicle->placeCar($newPosition);

        self::assertEquals($newPosition, $electricVehicle->getCityPosition());
    }

    public function testGetFuturePosition(): void
    {
        $cityPosition = ElectricVehicleCityPositionStub::create(5, 5);
        $direction = ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH);

        $electricVehicle = new ElectricVehicle($cityPosition, $direction);

        $futurePosition = $electricVehicle->getFuturePosition();

        self::assertEquals(5, $futurePosition->getPositionX());
        self::assertEquals(6, $futurePosition->getPositionY());
    }

    public function testTurn(): void
    {
        $electricVehicle = new ElectricVehicle(
            ElectricVehicleCityPositionStub::random(),
            ElectricVehicleDirectionStub::create(ElectricVehicleDirection::NORTH)
        );

        $electricVehicle->turn(ElectricVehicle::RIGHT);
        self::assertEquals(ElectricVehicleDirection::EAST, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::RIGHT);
        self::assertEquals(ElectricVehicleDirection::SOUTH, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::RIGHT);
        self::assertEquals(ElectricVehicleDirection::WEST, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::RIGHT);
        self::assertEquals(ElectricVehicleDirection::NORTH, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::LEFT);
        self::assertEquals(ElectricVehicleDirection::WEST, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::LEFT);
        self::assertEquals(ElectricVehicleDirection::SOUTH, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::LEFT);
        self::assertEquals(ElectricVehicleDirection::EAST, $electricVehicle->getDirection()->value());

        $electricVehicle->turn(ElectricVehicle::LEFT);
        self::assertEquals(ElectricVehicleDirection::NORTH, $electricVehicle->getDirection()->value());

    }

}