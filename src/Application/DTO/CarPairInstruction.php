<?php

declare(strict_types=1);

namespace Kata\Application\DTO;


class CarPairInstruction
{
    public $deployPosition;
    public $instructionSet;

    public function __construct(ElectricVehicleDTO $evPO, array $instructionSet)
    {
        $this->deployPosition = $evPO;
        $this->instructionSet = $instructionSet;
    }

}