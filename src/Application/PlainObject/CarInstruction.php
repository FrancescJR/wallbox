<?php

declare(strict_types=1);

namespace Kata\Application\PlainObject;


class CarInstruction
{
    public $deployPosition;
    public $instructionSet;

    public function __construct(ElectricVehiclePlainObject $evPO, array $instructionSet)
    {
        $this->deployPosition = $evPO;
        $this->instructionSet = $instructionSet;
    }

}