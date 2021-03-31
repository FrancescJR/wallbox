<?php

declare(strict_types=1);

namespace Kata\Application\Command;

interface CreateNavigateCommandInterface
{
    /**
     * @param $input
     * @return NavigateElectricVehiclesCommand
     */
    public function createNavigateElectricVehiclesCommand($input): NavigateElectricVehiclesCommand;
}
