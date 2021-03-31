<?php

declare(strict_types=1);

namespace Kata\Infrastructure\CLI;

use Kata\Application\Command\CreateNavigateCommandInterface;
use Kata\Application\UseCase\NavigateElectricVehiclesUseCaseInterface;
use Kata\Domain\Exception\DomainException;
use Kata\Infrastructure\Exception\InfrastructureException;
use Kata\Infrastructure\Presenter\ElectricVehicleListStdOutPresenter;

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
            $electricVehicleListPresenter = new ElectricVehicleListStdOutPresenter();

            $input = [];
            while ($line = fgets(STDIN)) {
                $input[]  = $line;
            }

            $navigateCommand = $this->commandBuilder->createNavigateElectricVehiclesCommand($input);

            $this->navigateElectricVehicles->navigateVehicles(
                $navigateCommand,
                $electricVehicleListPresenter
            );

        } catch (DomainException $e) {
            echo $e->getMessage();
        } catch (InfrastructureException $e) {

        }
    }
}