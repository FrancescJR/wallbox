<?php

declare(strict_types=1);

namespace Kata\Application\Service;


use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\ElectricVehicle\ElectricVehicle;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;

class DeployVehicleInCityService
{

    public function execute(string $direction, int $cityPositionX, int $cityPositionY, City $city): ElectricVehicle
    {
        if ($cityPositionX > $city->getLimitX()) {
            throw new VehicleOutOfRangeException("Can't deploy out of the limits of the city");
        }

        if ($cityPositionY > $city->getLimitY()) {
            throw new VehicleOutOfRangeException("Can't deploy out of the limits of the city");
        }

        foreach($city->getVehicles() as $electricVehicleInCity) {
            if ($electricVehicleInCity->getCityPosition()->getPositionX() == $cityPositionX &&
                $electricVehicleInCity->getCityPosition()->getPositionY() == $cityPositionY) {
                throw new PositionAlreadyInUseException("Can't create on an used position.");
            }
        }

        $electricVehicle = new ElectricVehicle(
            new ElectricVehicleCityPosition($cityPositionX, $cityPositionY),
            new ElectricVehicleDirection($direction)
        );

        $city->addVehicle($electricVehicle);

        return $electricVehicle;
    }

}