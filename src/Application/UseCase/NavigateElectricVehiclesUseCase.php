<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;

use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\DTO\CarPairInstruction;
use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;
use Kata\Application\Service\CreateCityService;
use Kata\Domain\ElectricVehicle\ElectricVehicleFactoryInterface;
use Kata\Domain\Shared\Service\DeployVehicleInCityService;
use Kata\Domain\Shared\Service\MoveVehicleInCityService;

class NavigateElectricVehiclesUseCase implements NavigateElectricVehiclesUseCaseInterface
{
    public const MOVE = 'M';

    private $cityService;

    private $electricVehicleFactory;

    private $deployVehicleInCityService;

    private $moveVehicleInCityService;

    public function __construct(
        CreateCityService $cityService,
        ElectricVehicleFactoryInterface $electricVehicleFactory,
        DeployVehicleInCityService $deployVehicleInCityService,
        MoveVehicleInCityService $moveVehicleInCityService
    ) {
        $this->cityService = $cityService;
        $this->electricVehicleFactory = $electricVehicleFactory;
        $this->deployVehicleInCityService = $deployVehicleInCityService;
        $this->moveVehicleInCityService = $moveVehicleInCityService;
    }

    /**
     * @param NavigateElectricVehiclesCommand $vehiclesCommand
     * @return ElectricVehicleDTO[]
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

            foreach ($carPairInstruction->instructionSet as $driveInstruction) {
                if ($driveInstruction === self::MOVE) {
                    $this->moveVehicleInCityService->execute($electricVehicle, $city);
                } else {
                    $electricVehicle->turn($driveInstruction);
                }
            }
            $finalVehiclePositions[] = ElectricVehicleDTO::creteFromElectiveVehicle($electricVehicle);
        }

        return $presenter->write($finalVehiclePositions);
    }
}
