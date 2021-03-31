<?php

declare(strict_types=1);

namespace Kata\Tests\Domain\Shared\Service;


use Kata\Application\Service\InterpretNavigationInstructionService;
use Kata\Domain\ElectricVehicle\ElectricVehicle;
use Kata\Domain\Shared\Service\MoveVehicleInCityService;
use Kata\Stubs\Domain\City\CityStub;
use PHPUnit\Framework\TestCase;

class InterpretNavigationInstructionServiceTest extends TestCase
{
    private $moveVehicleService;

    public function setUp(): void
    {
        $this->moveVehicleService = self::createMock(MoveVehicleInCityService::class);
    }

    public function testNavigation(): void
    {
        $service = new InterpretNavigationInstructionService($this->moveVehicleService);

        $instruction = ['M', 'M', 'L', 'R', 'M', 'L'];

        $this->moveVehicleService->expects($this->exactly(3))->method('execute');

        $electricVehicle = self::createMock(ElectricVehicle::class);

        $electricVehicle->expects($this->exactly(3))->method('turn');

        $service->navigateFollowingInstructions($instruction, $electricVehicle, CityStub::random());

    }

}