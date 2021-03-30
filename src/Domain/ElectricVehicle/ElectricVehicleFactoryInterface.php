<?php


namespace Kata\Domain\ElectricVehicle;


use Kata\Application\DTO\ElectricVehicleDTO;

interface ElectricVehicleFactoryInterface
{
    public function createFromPO(ElectricVehicleDTO $evPO): ElectricVehicle;

}