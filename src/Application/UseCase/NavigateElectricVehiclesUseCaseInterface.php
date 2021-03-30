<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;

use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Command\NavigateElectricVehiclesCommand;

interface NavigateElectricVehiclesUseCaseInterface
{
    /**
     * @param NavigateElectricVehiclesCommand $vehiclesCommand
     * @return ElectricVehicleDTO[]
     */
    public function navigateVehicles(NavigateElectricVehiclesCommand $vehiclesCommand): array;
}
