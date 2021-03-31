<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;

use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;

interface NavigateElectricVehiclesUseCaseInterface
{
    /**
     * @param NavigateElectricVehiclesCommand $vehiclesCommand
     * @param ElectricVehiclesListPresenter $presenter
     * @return ElectricVehicleDTO[]
     */
    public function navigateVehicles(
        NavigateElectricVehiclesCommand $vehiclesCommand,
        ElectricVehiclesListPresenter $presenter
    ): array;
}
