<?php

declare(strict_types=1);

namespace Kata\Stubs\Domain\ElectricVehicle\ValueObject;


use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;

class ElectricVehicleCityPositionStub
{
    public static function create($positionX, $positionY): ElectricVehicleCityPosition
    {
        return new ElectricVehicleCityPosition(
            $positionX,
            $positionY
        );
    }

    public static function random():ElectricVehicleCityPosition
    {
        return self::create(rand(0,50), rand(0,50));
    }

}