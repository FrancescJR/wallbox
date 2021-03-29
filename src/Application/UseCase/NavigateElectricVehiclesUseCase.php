<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;


use Kata\Application\Service\CreateCityService;
use Kata\Application\Service\DeployVehicleInCityService;
use Kata\Application\Service\MoveVehicleInCityService;

class NavigateElectricVehiclesUseCase
{
    private $cityService;

    private $deployVehicleInCityService;

    private $moveVehicleInCityService;

    public function __construct(
        CreateCityService $cityService,
        DeployVehicleInCityService $deployVehicleInCityService,
        MoveVehicleInCityService $moveVehicleInCityService
    ) {
        $this->cityService = $cityService;
        $this->deployVehicleInCityService = $deployVehicleInCityService;
        $this->moveVehicleInCityService = $moveVehicleInCityService;
    }

    public function execute(NavigateElectricVehiclesCommand $vehiclesCommand)
    {
        $city = $this->cityService->execute();



    }

}