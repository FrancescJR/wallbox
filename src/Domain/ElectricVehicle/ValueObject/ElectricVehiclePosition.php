<?php

declare(strict_types=1);

namespace Kata\Domain\ElectricVehicle\ValueObject;


use Kata\Domain\ElectricVehicle\Exception\InvalidElectricVehiclePositionException;

class ElectricVehiclePosition
{
    private $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function value():int
    {
        return $this->value;
    }

    private function setValue(int $value)
    {
        if(0 > $value) {
            throw new InvalidElectricVehiclePositionException("Vehicle position must be above 0");
        }
        $this->value = $value;
    }



}