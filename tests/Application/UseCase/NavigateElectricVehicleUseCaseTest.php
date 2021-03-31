<?php

declare(strict_types=1);

namespace Kata\Tests\Application\UseCase;


use Kata\Application\Command\NavigateElectricVehiclesCommand;
use Kata\Application\DTO\CarPairInstruction;
use Kata\Application\DTO\CityDTO;
use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Application\Presenter\ElectricVehiclesListPresenter;
use Kata\Application\Service\CreateCityService;
use Kata\Application\Service\InterpretNavigationInstructionService;
use Kata\Application\UseCase\NavigateElectricVehiclesUseCase;
use Kata\Domain\ElectricVehicle\ElectricVehicleFactoryInterface;
use Kata\Domain\Shared\Service\DeployVehicleInCityService;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use PHPUnit\Framework\TestCase;

class NavigateElectricVehicleUseCaseTest extends TestCase
{
    private $cityService;
    private $evFactory;
    private $deployVehicleService;
    private $navigateByInstructionService;
    private $presenter;

    public function setUp():void
    {
        $this->cityService = $this->createMock(CreateCityService::class);
        $this->evFactory = $this->createMock(ElectricVehicleFactoryInterface::class);
        $this->deployVehicleService = $this->createMock(DeployVehicleInCityService::class);
        $this->navigateByInstructionService = $this->createMock(InterpretNavigationInstructionService::class);
        $this->presenter = $this->createMock(ElectricVehiclesListPresenter::class);
    }

    public function testSuccess(): void
    {
        $useCase = new NavigateElectricVehiclesUseCase(
            $this->cityService,
            $this->evFactory,
            $this->deployVehicleService,
            $this->navigateByInstructionService
        );

        $useCaseCommand = new NavigateElectricVehiclesCommand(
            new CityDTO(10,10),
            [
                new CarPairInstruction(
                    ElectricVehicleDTO::creteFromElectiveVehicle(ElectricVehicleStub::random()),
                    ['R','M']
                ),
                new CarPairInstruction(
                    ElectricVehicleDTO::creteFromElectiveVehicle(ElectricVehicleStub::random()),
                    ['R','M']
                )
            ]
        );

        $this->evFactory->expects($this->exactly(2))->method('createFromPO');
        $this->deployVehicleService->expects($this->exactly(2))->method('execute');
        $this->navigateByInstructionService->expects($this->exactly(2))->method('navigateFollowingInstructions');

        $useCase->navigateVehicles($useCaseCommand, $this->presenter);
    }


}