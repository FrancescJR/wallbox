<?php

declare(strict_types=1);

namespace Kata\Infrastructure\Service;

use Kata\Application\Command\CreateNavigateCommandInterface;
use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\DTO\CarPairInstruction;
use Kata\Application\DTO\CityDTO;
use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Infrastructure\Exception\InfrastructureException;

class CreateNavigateEVCommandFromStdInService implements CreateNavigateCommandInterface
{

    /**
     * @param $input
     * @return NavigateElectricVehiclesCommand
     * @throws InfrastructureException
     */
    public function createNavigateElectricVehiclesCommand($input): NavigateElectricVehiclesCommand
    {
        if (! is_array($input)) {
            throw new InfrastructureException("This implementation of the builder needs input to be array");
        }

        if (count($input) % 2 !== 1) {
            throw new InfrastructureException("Input should have and odd number of lines");
        }

        if (count($input) < 1) {
            throw new InfrastructureException("Input should have at least one line");
        }

        try {
            $cityDTO = $this->getCityDTO($input[0]);

            $carPairInstructions = [];

            $index = 1;

            while (array_key_exists($index + 1, $input)) {
                $carPairInstructions[] = $this->getCarPairInstruction($input[$index], $input[$index+1]);
                $index +=2;
            }

            return new NavigateElectricVehiclesCommand($cityDTO, $carPairInstructions);
        } catch (\Throwable $exception) {
            throw new InfrastructureException("Could not parse input: " . $exception->getMessage());
        }
    }

    private function getCityDTO(string $input):CityDTO
    {
        // TODO check parsing line etc. and throw controlled exceptions
        $cityLimits = explode(" ", trim($input));

        return new CityDTO(
            (int) $cityLimits[0],
            (int) $cityLimits[1]
        );
    }

    private function getCarPairInstruction(string $carPart, string $instructionPart): CarPairInstruction
    {
        return new CarPairInstruction(
            $this->getEVDTO($carPart),
            $this->getInstructions($instructionPart)
        );
    }

    private function getEVDTO(string $carPart): ElectricVehicleDTO
    {
        // TODO check parsing line etc. and throw controlled exceptions
        $carDeployInformation = explode(" ", trim($carPart));
        return new ElectricVehicleDTO(
            (int) $carDeployInformation[0],
            (int) $carDeployInformation[1],
            $carDeployInformation[2]
        );
    }

    private function getInstructions(string $instructions): array
    {
        // TODO check parsing line etc. and throw controlled exceptions
        return str_split(trim($instructions));
    }
}
