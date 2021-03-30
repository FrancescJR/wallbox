<?php

declare(strict_types=1);

namespace Kata\Infrastructure\Factory;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Domain\ElectricVehicle\ElectricVehicle;
use Kata\Domain\ElectricVehicle\ElectricVehicleFactoryInterface;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;

class ElectricVehicleFactory implements ElectricVehicleFactoryInterface
{

    public function createFromPO(ElectricVehicleDTO $evPO): ElectricVehicle
    {
        return new ElectricVehicle(
            new ElectricVehicleCityPosition(
                (int) $evPO->positionX,
                (int) $evPO->positionY,
            ),
            new ElectricVehicleDirection(
                $evPO->direction
            )
        );
    }
}