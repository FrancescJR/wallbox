<?php

declare(strict_types=1);

namespace Kata\Stubs\Domain\ElectricVehicle\ValueObject;


use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;

class ElectricVehicleDirectionStub
{
    public static function create(string $direction): ElectricVehicleDirection
    {
        return new ElectricVehicleDirection($direction);
    }

    public static function random():ElectricVehicleDirection
    {
        return self::create(ElectricVehicleDirection::DIRECTIONS_ALLOWED[
            rand(0, count(ElectricVehicleDirection::DIRECTIONS_ALLOWED) - 1)
        ]);
    }

}