<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;

use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\DTO\CarPairInstruction;
use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;
use Kata\Application\Service\CreateCityService;
use Kata\Application\Service\InterpretNavigationInstructionService;
use Kata\Domain\ElectricVehicle\ElectricVehicleFactoryInterface;
use Kata\Domain\Exception\DomainException;
use Kata\Domain\Shared\Service\DeployVehicleInCityService;

class NavigateElectricVehiclesUseCase implements NavigateElectricVehiclesUseCaseInterface
{
    private $cityService;

    private $electricVehicleFactory;

    private $deployVehicleInCityService;

    private $navigateIncityservice;

    public function __construct(
        CreateCityService $cityService,
        ElectricVehicleFactoryInterface $electricVehicleFactory,
        DeployVehicleInCityService $deployVehicleInCityService,
        InterpretNavigationInstructionService $navigateIncityservice
    )
    {
        $this->cityService = $cityService;
        $this->electricVehicleFactory = $electricVehicleFactory;
        $this->deployVehicleInCityService = $deployVehicleInCityService;
        $this->navigateIncityservice = $navigateIncityservice;
    }

    /**
     * @param NavigateElectricVehiclesCommand $vehiclesCommand
     * @param ElectricVehiclesListPresenter $presenter
     * @return ElectricVehicleDTO[]
     *
     * @throws DomainException
     */
    public function navigateVehicles(
        NavigateElectricVehiclesCommand $vehiclesCommand,
        ElectricVehiclesListPresenter $presenter
    ): array
    {
        $city = $this->cityService->execute(
            $vehiclesCommand->getCityDTO()->cityLimitX,
            $vehiclesCommand->getCityDTO()->cityLimitY
        );

        $finalVehiclePositions = [];

        /** @var  $instruction  CarPairInstruction */
        foreach ($vehiclesCommand->getCarInstructions() as $carPairInstruction) {

            $electricVehicle = $this->electricVehicleFactory->createFromPO($carPairInstruction->deployPosition);

            $this->deployVehicleInCityService->execute($electricVehicle, $city);

            $this->navigateIncityservice->navigateFollowingInstructions($carPairInstruction->instructionSet, $electricVehicle, $city);

            $finalVehiclePositions[] = ElectricVehicleDTO::creteFromElectiveVehicle($electricVehicle);
        }

        return $presenter->write($finalVehiclePositions);
    }
}
