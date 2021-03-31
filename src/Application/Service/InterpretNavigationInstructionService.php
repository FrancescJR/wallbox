<?php

declare(strict_types=1);

namespace Kata\Application\Service;


use Kata\Domain\City\City;
use Kata\Domain\City\Exception\PositionAlreadyInUseException;
use Kata\Domain\ElectricVehicle\ElectricVehicle;
use Kata\Domain\ElectricVehicle\Exception\InvalidTurningDirectionException;
use Kata\Domain\Shared\Service\MoveVehicleInCityService;

class InterpretNavigationInstructionService
{
    public const MOVE = 'M';

    private $moveVehicleInCityService;

    public function __construct(MoveVehicleInCityService $moveVehicleInCityService)
    {
        $this->moveVehicleInCityService = $moveVehicleInCityService;
    }

    /**
     * @param array $instructions
     * @param ElectricVehicle $electricVehicle
     * @param City $city
     * @throws PositionAlreadyInUseException
     * @throws InvalidTurningDirectionException
     */
    public function navigateFollowingInstructions(array $instructions, ElectricVehicle $electricVehicle, City $city): void
    {
        foreach ($instructions as $driveInstruction) {
            if ($driveInstruction === self::MOVE) {
                $this->moveVehicleInCityService->execute($electricVehicle, $city);
            } else {
                $electricVehicle->turn($driveInstruction);
            }
        }
    }


}