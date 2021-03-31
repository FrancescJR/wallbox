<?php

declare(strict_types=1);

namespace Kata\Infrastructure\Presenter;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;

class ElectricVehicleListStdOutPresenter implements ElectricVehiclesListPresenter
{

    /**
     * @param array $electricVehiclesDTOList
     */
    public function write(array $electricVehiclesDTOList): void
    {
        /** @var  $electricVehicleDTO ElectricVehicleDTO */
        foreach($electricVehiclesDTOList as $electricVehicleDTO) {
            echo (string) $electricVehicleDTO->positionX . " " . (string) $electricVehicleDTO->positionY . " " . $electricVehicleDTO->direction;
        }
    }
}