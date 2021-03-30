<?php

declare(strict_types=1);

namespace Kata\Domain\Shared\Service;

use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\City\ValueObject\CityLimit;
use Kata\Domain\ElectricVehicle\ElectricVehicle;

class DeployVehicleInCityService
{
    public function execute(ElectricVehicle $ev, City $city): void
    {
        if ($ev->getCityPosition()->getPositionX() > $city->getLimitX() or
            $ev->getCityPosition()->getPositionY() > $city->getLimitY() or
            $ev->getCityPosition()->getPositionY() < CityLimit::MINIMUM_LIMIT or
            $ev->getCityPosition()->getPositionX() < CityLimit::MINIMUM_LIMIT
        ) {
            throw new VehicleOutOfRangeException("Can't deploy out of the limits of the city");
        }

        foreach ($city->getVehicles() as $electricVehicleInCity) {
            if ($electricVehicleInCity->getCityPosition()->getPositionX() == $ev->getCityPosition()->getPositionX() &&
                $electricVehicleInCity->getCityPosition()->getPositionY() == $ev->getCityPosition()->getPositionY()) {
                throw new PositionAlreadyInUseException("Can't create on an used position.");
            }
        }

        $city->addVehicle($ev);
    }
}
