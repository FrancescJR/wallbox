<?php

declare(strict_types=1);

namespace Kata\Application\Command;


interface CreateNavigateCommandInterface
{

    public function createNavigateElectricVehiclesCommand($input): NavigateElectricVehiclesCommand;

}