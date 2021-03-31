<?php

declare(strict_types=1);

namespace Kata\Tests\Infrastructure\Service;


use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\DTO\CarPairInstruction;
use Kata\Application\DTO\CityDTO;
use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Infrastructure\Exception\InfrastructureException;
use Kata\Infrastructure\Service\CreateNavigateEVCommandFromStdInService;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use PHPUnit\Framework\TestCase;

class CreateNavigateEVCommandFromStdInServiceTest extends TestCase
{
    public function testInvalidLinesArray(): void
    {
        $input = ["ctiy limit", "one part"];

        $service = new CreateNavigateEVCommandFromStdInService();

        self::expectException(InfrastructureException::class);

        $service->createNavigateElectricVehiclesCommand($input);
    }

    public function testNotArray(): void
    {
        $input = "hello";

        $service = new CreateNavigateEVCommandFromStdInService();

        self::expectException(InfrastructureException::class);

        $service->createNavigateElectricVehiclesCommand($input);
    }

    public function testEmptyInput(): void
    {
        $input = [];

        $service = new CreateNavigateEVCommandFromStdInService();

        self::expectException(InfrastructureException::class);

        $service->createNavigateElectricVehiclesCommand($input);
    }

    public function testSuccess(): void
    {
        $input = [
            '5 5',
            '1 2 N',
            'LMLMLM',
            '3 3 S',
            'MLMRRR',
            '4 4 E',
            'MMMMMM'
        ];

        $service = new CreateNavigateEVCommandFromStdInService();

        $command = $service->createNavigateElectricVehiclesCommand($input);

        $expectedResult = new NavigateElectricVehiclesCommand(
            new CityDTO(5,5),
            [
                new CarPairInstruction(
                    new ElectricVehicleDTO(1,2,"N"),
                    ['L','M','L','M','L','M']
                ),
                new CarPairInstruction(
                    new ElectricVehicleDTO(3,3,"S"),
                    ['M','L','M','R','R','R']
                ),
                new CarPairInstruction(
                    new ElectricVehicleDTO(4,4,"E"),
                    ['M','M', 'M','M','M','M']
                )
            ]
        );

        self::assertEquals($expectedResult, $command);

    }

    // TODO a lot of test for input errors.

}