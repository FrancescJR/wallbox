<?php

declare(strict_types=1);

namespace Kata\Application\DTO;

use Kata\Domain\ElectricVehicle\ElectricVehicle;

class ElectricVehicleDTO
{
    public $positionX;
    public $positionY;
    public $direction;

    public function __construct(int $positionX, int $positionY, string $direction)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
        $this->direction = $direction;
    }

    public static function creteFromElectiveVehicle(ElectricVehicle $ev): ElectricVehicleDTO
    {
        return new ElectricVehicleDTO(
            $ev->getCityPosition()->getPositionX(),
            $ev->getCityPosition()->getPositionY(),
            $ev->getDirection()->value()
        );
    }
}
