<?php

declare(strict_types=1);

namespace Kata\Domain\ElectricVehicle\ValueObject;

use Kata\Domain\ElectricVehicle\Exception\InvalidElectricVehicleDirectionException;

class ElectricVehicleDirection
{
    public const NORTH = 'N';
    public const EAST = 'E';
    public const WEST = 'W';
    public const SOUTH = 'S';

    public const DIRECTIONS_ALLOWED = [
        self::NORTH,
        self::EAST,
        self::WEST,
        self::SOUTH
    ];

    private $value;

    public function __construct(string $direction)
    {
        $this->setDirection($direction);
    }

    private function setDirection(string $direction)
    {
        if (!in_array($direction, self::DIRECTIONS_ALLOWED)) {
            throw new InvalidElectricVehicleDirectionException("cant turn vehicle in $direction direction.");
        }
        $this->value = $direction;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
