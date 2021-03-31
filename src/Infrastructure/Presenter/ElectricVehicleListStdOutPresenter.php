<?php

declare(strict_types=1);

namespace Kata\Infrastructure\Presenter;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;

class ElectricVehicleListStdOutPresenter implements ElectricVehiclesListPresenter
{

    public function write(array $electricVehiclesDTOList): array
    {
        $result = [];
        /** @var  $electricVehicleDTO ElectricVehicleDTO */
        foreach($electricVehiclesDTOList as $electricVehicleDTO) {
            $result =  (string) $electricVehicleDTO->positionX . " " . (string) $electricVehicleDTO->positionY . " " . $electricVehicleDTO->direction."\n";
            echo $result;
        }
        return $result;
    }
}