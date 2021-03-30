<?php

declare(strict_types=1);

namespace Kata\Domain\City;

use Kata\Domain\City\ValueObject\CityLimit;
use Kata\Domain\ElectricVehicle\ElectricVehicle;

class City
{
    private $limitX;

    private $limitY;

    private $vehicles;

    public function __construct(CityLimit $limitX, CityLimit $limitY)
    {
        $this->limitX = $limitX;
        $this->limitY = $limitY;
        $this->vehicles = [];
    }

    /**
     * @return CityLimit
     */
    public function getLimitX(): CityLimit
    {
        return $this->limitX;
    }

    /**
     * @return CityLimit
     */
    public function getLimitY(): CityLimit
    {
        return $this->limitY;
    }

    /**
     * @return ElectricVehicle[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    public function addVehicle(ElectricVehicle $ev): void
    {
        $this->vehicles[] = $ev;
    }
}
