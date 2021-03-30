<?php

declare(strict_types=1);

namespace Kata\Application\PlainObject;


use Kata\Domain\ElectricVehicle\ElectricVehicle;

class ElectricVehiclePlainObject
{
    public $positionX;
    public $positionY;
    public $direction;

    public function __construct(string $positionX, string $positionY, string $direction)
    {
        $this->positionY = $positionX;
        $this->positionX = $positionY;
        $this->direction = $direction;
    }

    public static function creteFromElectiveVehicle(ElectricVehicle $ev)
    {
        return new ElectricVehiclePlainObject(
            (string) $ev->getCityPosition()->getPositionY(),
            (string) $ev->getCityPosition()->getPositionY(),
            $ev->getDirection()->value());
    }

    public function write()
    {
        return $this->positionX . " " . $this->positionY . " " . $this->direction;
    }

}