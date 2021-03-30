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
            while($line = fgets(STDIN)){
                $input[]  = $line;
            }
            $navigateCommand = $this->commandBuilder->createNavigateElectricVehiclesCommand($input);
            $this->navigateElectricVehicles->navigateVehicles($navigateCommand);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }
}