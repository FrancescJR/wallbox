<?php

declare(strict_types=1);

namespace Kata\Domain\ElectricVehicle;


use Kata\Domain\ElectricVehicle\Exception\InvalidTurningDirectionException;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehicleDirection;
use Kata\Domain\ElectricVehicle\ValueObject\ElectricVehiclePosition;

class ElectricVehicle
{
    public const RIGHT = 'R';
    public const LEFT = 'L';

    public const TURN_DIRECTIONS_ALLOWED = [
        self::LEFT,
        self::RIGHT
    ];

    private $positionGridX;

    private $positionGridY;

    private $direction;

    public function __construct(
        ElectricVehiclePosition $positionX,
        ElectricVehiclePosition $positionY,
        ElectricVehicleDirection $direction
    )
    {
        $this->positionGridX = $positionX;
        $this->positionGridY = $positionY;
        $this->direction = $direction;
    }

    /**
     * @return ElectricVehiclePosition
     */
    public function getPositionGridX(): ElectricVehiclePosition
    {
        return $this->positionGridX;
    }

    /**
     * @return ElectricVehiclePosition
     */
    public function getPositionGridY(): ElectricVehiclePosition
    {
        return $this->positionGridY;
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
        switch ($this->direction) {
            case ElectricVehicleDirection::NORTH:
                $this->positionGridY = new ElectricVehiclePosition($this->positionGridY->value() + 1);
                break;
            case ElectricVehicleDirection::SOUTH:
                $this->positionGridY = new ElectricVehiclePosition($this->positionGridY->value() - 1);
                break;
            case ElectricVehicleDirection::WEST:
                $this->positionGridX = new ElectricVehiclePosition($this->positionGridX->value() - 1);
                break;
            case ElectricVehicleDirection::EAST:
                $this->positionGridX = new ElectricVehiclePosition($this->positionGridX->value() + 1);
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
        // this could be done in a smarter way. I am not smart. I like explicit things.
        switch ($this->direction) {
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