<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;

use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;
use Kata\Domain\Exception\DomainException;

interface NavigateElectricVehiclesUseCaseInterface
{
    /**
     * @param NavigateElectricVehiclesCommand $vehiclesCommand
     * @param ElectricVehiclesListPresenter $presenter
     * @return array
     *
     * @throws DomainException
     */
    public function navigateVehicles(
        NavigateElectricVehiclesCommand $vehiclesCommand,
        ElectricVehiclesListPresenter $presenter
    ): array;
}
