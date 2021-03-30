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
    )
    {
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

    public function move(): void
    {
        switch ($this->direction->value()) {
            case ElectricVehicleDirection::NORTH:
                $this->cityPosition = new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX(),
                    $this->cityPosition->getPositionY() + 1,
                );
                break;
            case ElectricVehicleDirection::SOUTH:
                $this->cityPosition = new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX(),
                    $this->cityPosition->getPositionY() - 1,
                );
                break;
            case ElectricVehicleDirection::WEST:
                $this->cityPosition = new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX() - 1,
                    $this->cityPosition->getPositionY(),
                );
                break;
            case ElectricVehicleDirection::EAST:
                $this->cityPosition = new ElectricVehicleCityPosition(
                    $this->cityPosition->getPositionX() + 1,
                    $this->cityPosition->getPositionY(),
                );
                break;
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