<?php


namespace Kata\Domain\ElectricVehicle;


use Kata\Application\PlainObject\ElectricVehiclePlainObject;

interface ElectricVehicleFactoryInterface
{
    public function createFromPO(ElectricVehiclePlainObject $evPO): ElectricVehicle;

}