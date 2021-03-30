<?php

declare(strict_types=1);

namespace Kata\Application\UseCase;


use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\PlainObject\CarInstruction;
use Kata\Application\PlainObject\ElectricVehiclePlainObject;
use Kata\Application\Service\CreateCityService;
use Kata\Domain\ElectricVehicle\ElectricVehicleFactoryInterface;
use Kata\Domain\Shared\Service\DeployVehicleInCityService;
use Kata\Domain\Shared\Service\MoveVehicleInCityService;

class NavigateElectricVehiclesUseCase
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

    public function execute(NavigateElectricVehiclesCommand $vehiclesCommand): array
    {
        $city = $this->cityService->execute(
            $vehiclesCommand->cityLimitX,
            $vehiclesCommand->cityLimitY
        );

        $finalVehiclePositions = [];

        /** @var  $instruction  CarInstruction */
        foreach($vehiclesCommand->carInstructions as $carInstruction) {
            $electricVehicle =$this->electricVehicleFactory->createFromPO($carInstruction->deployPosition);

            $this->deployVehicleInCityService->execute($electricVehicle, $city);
            foreach ($carInstruction->instructionSet as $driveInstruction) {
                if ($instruction === self::MOVE) {
                    $this->moveVehicleInCityService->execute($electricVehicle, $city);
                } else {
                    $electricVehicle->turn($driveInstruction);
                }
            }
            $finalVehiclePositions[] = ElectricVehiclePlainObject::creteFromElectiveVehicle($electricVehicle);
        }

        return $finalVehiclePositions;

    }

}