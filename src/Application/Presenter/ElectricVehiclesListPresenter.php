<?php


namespace Kata\Application\Presenter;


use Kata\Application\DTO\ElectricVehicleDTO;

interface ElectricVehiclesListPresenter
{
    /**
     * @param ElectricVehicleDTO[]
     */
    public function write(array $electricVehiclesDTOList): void;
}