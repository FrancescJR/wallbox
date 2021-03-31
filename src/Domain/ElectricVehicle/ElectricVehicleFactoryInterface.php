<?php


namespace Kata\Domain\ElectricVehicle;

use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Domain\ElectricVehicle\Exception\InvalidElectricVehicleDirectionException;

interface ElectricVehicleFactoryInterface
{
    /**
     * @param ElectricVehicleDTO $evPO
     * @return ElectricVehicle
     * @throws InvalidElectricVehicleDirectionException
     */
    public function createFromPO(ElectricVehicleDTO $evPO): ElectricVehicle;
}
