<?php

declare(strict_types=1);

namespace Kata\Application\PlainObject;


use Kata\Domain\ElectricVehicle\ElectricVehicle;

class ElectricVehiclePlainObject
{
    public $positionX;
    public $positionY;
    public $direction;

    public function __construct(ElectricVehicle $ev)
    {
        $this->positionY = (string) $ev->getCityPosition()->getPositionY();
        $this->positionX = (string) $ev->getCityPosition()->getPositionX();
        $this->direction = $ev->getDirection()->value();
    }

    public function write()
    {
        return $this->positionX . " " . $this->positionY . " " . $this->direction;
    }

}