<?php

declare(strict_types=1);

namespace Kata\Infrastructure\IO;

use Kata\Application\Command\CreateNavigateCommandInterface;
use Kata\Application\UseCase\NavigateElectricVehiclesUseCaseInterface;

class NavigateElectricVehiclesCLI
{
    private $navigateElectricVehicles;
    private $commandBuilder;

    public function __construct(NavigateElectricVehiclesUseCaseInterface $navigateElectricVehicles, CreateNavigateCommandInterface $commandBuilder)
    {
        $this->navigateElectricVehicles = $navigateElectricVehicles;
        $this->commandBuilder = $commandBuilder;
    }

    public function execute()
    {
        try {
            $input = [];
            while ($line = fgets(STDIN)) {
                $input[]  = $line;
            }
            $navigateCommand = $this->commandBuilder->createNavigateElectricVehiclesCommand($input);

            $evEndingPositions = $this->navigateElectricVehicles->navigateVehicles($navigateCommand);
            /** @var $endingPosition \Kata\Application\DTO\ElectricVehicleDTO */
            foreach($evEndingPositions as $endingPosition) {
                echo "printing a car";
                echo $endingPosition->write();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
