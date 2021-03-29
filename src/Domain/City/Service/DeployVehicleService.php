<?php

declare(strict_types=1);

namespace Kata\Domain\City\Service;


use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\ElectricVehicle\ElectricVehicle;

class DeployVehicleService
{
    public function deployVehicleToCity(ElectricVehicle $ev, City $city)
    {
        if($ev->getPositionGridX()->value() > $city->getLimitX()) {
            throw new VehicleOutOfRangeException("Can't deploy out of the limits of the city");
        }

        if($ev->getPositionGridY()->value() > $city->getLimitY()) {
            throw new VehicleOutOfRangeException("Can't deploy out of the limits of the city");
        }

        foreach($city->getVehicles() as $electricVehicleInCity) {
            if ($electricVehicleInCity->getPositionGridX()->value() == $ev->getPositionGridX()->value() &&
                $electricVehicleInCity->getPositionGridY()->value() == $ev->getPositionGridY()->value()) {
                throw new PositionAlreadyInUseException("Can't deploy on an used position.");
            }
        }

        $city->addVehicle($ev);

    }

}