<?php

declare(strict_types=1);

namespace Kata\Domain\ElectricVehicle\ValueObject;


use Kata\Domain\ElectricVehicle\Exception\InvalidElectricVehiclePositionException;

class ElectricVehicleCityPosition
{
    private int $positionX;
    private int $positionY;

    public function __construct(int $positionX, int $positionY)
    {
        $this->positionX = $positionX;
        $this->positionY = $positionY;
    }

    public function getPositionX():int
    {
        return $this->positionX;
    }

    public function getPositionY():int
    {
        return $this->positionY;
    }




}