<?php

declare(strict_types=1);

namespace Kata\Domain\City\ValueObject;

use Kata\Domain\City\Exception\InvalidCitySizeException;

class CityLimit
{
    public const MINIMUM_LIMIT = 0;

    private $value;

    /**
     * CityLimit constructor.
     * @param int $value
     * @throws InvalidCitySizeException
     */
    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function value():int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @throws InvalidCitySizeException
     */
    private function setValue(int $value)
    {
        if (self::MINIMUM_LIMIT > $value) {
            throw new InvalidCitySizeException("City limit must be above 0");
        }
        $this->value = $value;
    }
}
