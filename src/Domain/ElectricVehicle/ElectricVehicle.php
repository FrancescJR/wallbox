<?php

declare(strict_types=1);

namespace Kata\Domain\ElectricVehicle;

use Kata\Domain\ElectricVehicle\Exception\InvalidTurningDirectionException;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleCityPosition;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;

class ElectricVehicle
{
    public const RIGHT = 'R';
    public const LEFT = 'L';

    public const TURN_DIRECTIONS_ALLOWED = [
        self::LEFT,
        self::RIGHT
    ];

    private $cityPosition;

    private $direction;

    public function __construct(
        ElectricVehicleCityPosition $position,
        ElectricVehicleDirection $direction
    ) {
        $this->cityPosition = $position;
        $this->direction = $direction;
    }

    /**
     * @return ElectricVehicleCityPosition
     */
    public function getCityPosition(): ElectricVehicleCityPosition
    {
        return $this->cityPosition;
    }


    /**
     * @return ElectricVehicleDirection
     */
    public function getDirection(): ElectricVehicleDirection
    {
        return $this->direction;
    }

    public function placeCar(ElectricVehicleCityPosition $cityPosition)
    {
        $this->cityPosition = $cityPosition;
    }


    public function getFuturePosition(): ElectricVehicleCityPosition
    {
        switch ($this->direction->value()) {
            case ElectricVehicleDirection::NORTH:
                return new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX(),
                    $this->cityPosition->getPositionY() + 1,
                );
            case ElectricVehicleDirection::SOUTH:
                return new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX(),
                    $this->cityPosition->getPositionY() - 1,
                );
            case ElectricVehicleDirection::WEST:
                return new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX() - 1,
                    $this->cityPosition->getPositionY(),
                );
            case ElectricVehicleDirection::EAST:
                return new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX() + 1,
                    $this->cityPosition->getPositionY(),
                );
        }
    }


    public function turn(string $turningDirection): void
    {
        switch ($turningDirection) {
            case self::RIGHT:
                $this->turnRight();
                break;
            case self::LEFT:
                $this->turnLeft();
                break;
            default:
                throw new InvalidTurningDirectionException("Cant turn in this direction: $turningDirection");
        }
    }

    private function turnLeft(): void
    {
        // this could be done in a smarter way. I am not smart. I like explicit things. Easier to fix.
        switch ($this->direction->value()) {
            case ElectricVehicleDirection::NORTH:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::EAST);
                break;
            case ElectricVehicleDirection::SOUTH:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::WEST);
                break;
            case ElectricVehicleDirection::WEST:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::SOUTH);
                break;
            case ElectricVehicleDirection::EAST:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::NORTH);
                break;
        }
    }

    private function turnRight(): void
    {
        switch ($this->direction) {
            case ElectricVehicleDirection::NORTH:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::WEST);
                break;
            case ElectricVehicleDirection::SOUTH:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::EAST);
                break;
            case ElectricVehicleDirection::WEST:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::NORTH);
                break;
            case ElectricVehicleDirection::EAST:
                $this->direction = new ElectricVehicleDirection(ElectricVehicleDirection::SOUTH);
                break;
        }
    }
}
