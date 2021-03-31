<?php

declare(strict_types=1);

namespace Kata\Domain\Shared\Service;


use Kata\Domain\City\City;
use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\City\ValueObject\CityLimit;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;

class EVCityPositionAllowedService
{
    public function execute(ElectricVehicleCityPosition $cityPosition, City $city): void
    {
        if ($cityPosition->getPositionX() > $city->getLimitX()->value() or
            $cityPosition->getPositionY() > $city->getLimitY()->value() or
            $cityPosition->getPositionY() < CityLimit::MINIMUM_LIMIT or
            $cityPosition->getPositionX() < CityLimit::MINIMUM_LIMIT
        ) {
            throw new VehicleOutOfRangeException("City position is out of the limits of the city.");
        }

    }

}