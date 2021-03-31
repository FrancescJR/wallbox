<?php

declare(strict_types=1);

namespace Kata\Domain\Shared\Service;

use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\City\Exception\VehicleOutOfRangeException;
use Kata\Domain\City\ValueObject\CityLimit;
use Kata\Domain\ElectricVehicle\ElectricVehicle;

class MoveVehicleInCityService
{
    private $cityPositionAllowedService;

    public function __construct(EVCityPositionAllowedService $cityPositionAllowedService)
    {
        $this->cityPositionAllowedService = $cityPositionAllowedService;
    }

    public function execute(ElectricVehicle $ev, City $city): void
    {
        $futurePosition = $ev->getFuturePosition();

        $this->cityPositionAllowedService->execute($futurePosition, $city);

        foreach ($city->getVehicles() as $electricVehicleInCity) {
            if ($electricVehicleInCity === $ev) {
                continue;
            }
            if ($electricVehicleInCity->getCityPosition()->getPositionX() == $futurePosition->getPositionX() &&
                $electricVehicleInCity->getCityPosition()->getPositionY() == $futurePosition->getPositionY()) {
                throw new PositionAlreadyInUseException("Can't move on a used position.");
            }
        }

        $ev->placeCar($futurePosition);
    }
}
