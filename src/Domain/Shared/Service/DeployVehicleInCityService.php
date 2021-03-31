<?php

declare(strict_types=1);

namespace Kata\Domain\Shared\Service;

use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\ElectricVehicle\ElectricVehicle;

class DeployVehicleInCityService
{
    private $cityPositionAllowedService;

    public function __construct(EVCityPositionAllowedService $cityPositionAllowedService)
    {
        $this->cityPositionAllowedService = $cityPositionAllowedService;
    }

    public function execute(ElectricVehicle $ev, City $city): void
    {
        $this->cityPositionAllowedService->execute($ev->getCityPosition(), $city);

        foreach ($city->getVehicles() as $electricVehicleInCity) {
            if ($electricVehicleInCity->getCityPosition()->getPositionX() == $ev->getCityPosition()->getPositionX() &&
                $electricVehicleInCity->getCityPosition()->getPositionY() == $ev->getCityPosition()->getPositionY()) {
                throw new PositionAlreadyInUseException("Can't deploy on an used position.");
            }
        }

        $city->addVehicle($ev);
    }
}
