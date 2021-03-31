<?php


namespace Kata\Application\Presenter;


use Kata\Application\DTO\ElectricVehicleDTO;

interface ElectricVehiclesListPresenter
{
    /**
     * @param ElectricVehicleDTO[]
     * @return array
     */
    public function write(array $electricVehiclesDTOList): array;
}