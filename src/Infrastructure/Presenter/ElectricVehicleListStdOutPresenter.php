<?php

declare(strict_types=1);

namespace Kata\Infrastructure\Presenter;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;

class ElectricVehicleListStdOutPresenter implements ElectricVehiclesListPresenter
{

    public function write(array $electricVehiclesDTOList): array
    {
        $resultList = [];
        /** @var  $electricVehicleDTO ElectricVehicleDTO */
        foreach($electricVehiclesDTOList as $electricVehicleDTO) {
            $output =  (string) $electricVehicleDTO->positionX . " " . (string) $electricVehicleDTO->positionY . " " . $electricVehicleDTO->direction;
            $resultList [] = $output;
        }
        return $resultList;
    }
}