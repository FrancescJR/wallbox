<?php

declare(strict_types=1);

namespace Kata\Stubs\Domain\ElectricVehicle;


use Kata\Domain\ElectricVehicle\ElectricVehicle;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPositionStub;
use Kata\Stubs\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirectionStub;

class ElectricVehicleStub
{
    public static function create(ElectricVehicleCityPosition $position, ElectricVehicleDirection $direction): ElectricVehicle
    {
        return new ElectricVehicle($position, $direction);
    }

    public static function random(): ElectricVehicle
    {
        return self::create(
            ElectricVehicleCityPositionStub::random(),
            ElectricVehicleDirectionStub::random()
        );
    }

}