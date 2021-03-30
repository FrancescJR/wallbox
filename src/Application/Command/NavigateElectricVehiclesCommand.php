<?php

declare(strict_types=1);

namespace Kata\Application\Command;


use Kata\Application\DTO\CarPairInstruction;
use Kata\Application\DTO\CityDTO;

class NavigateElectricVehiclesCommand
{

    /**
     * @var
     */
    private $cityDTO;

    /**
     * @var CarPairInstruction[]
     */
    private $carInstructions;

    public function __construct(CityDTO $cityDTO, array $carInstructions)
    {
        $this->cityDTO = $cityDTO;
        $this->carInstructions = $carInstructions;
    }

    public function getCityDTO(): CityDTO
    {
        return $this->cityDTO;
    }

    public function getCarInstructions():array
    {
        return $this->carInstructions;
    }




}