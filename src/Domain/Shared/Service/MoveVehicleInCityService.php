<?php

declare(strict_types=1);

namespace Kata\Domain\Shared\Service;

use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\ElectricVehicle\ElectricVehicle;

class MoveVehicleInCityService
{
    public function execute(ElectricVehicle $ev, City $city)
    {
        $ev->move();

        if ($ev->getCityPosition()->getPositionX() > $city->getLimitX()) {
            throw new VehicleOutOfRangeException("Can't move out of the limits of the city");
        }

        if ($ev->getCityPosition()->getPositionY() > $city->getLimitY()) {
            throw new VehicleOutOfRangeException("Can't move out of the limits of the city");
        }

        foreach ($city->getVehicles() as $electricVehicleInCity) {
            if ($electricVehicleInCity->getCityPosition()->getPositionX() == $ev->getCityPosition()->getPositionX() &&
                $electricVehicleInCity->getCityPosition()->getPositionY() == $ev->getCityPosition()->getPositionY()) {
                throw new PositionAlreadyInUseException("Can't move on an used position.");
            }
        }
    }
}
