<?php

declare(strict_types=1);

namespace Kata\Domain\City\ValueObject;


use Kata\Domain\City\Exception\InvalidCitySizeException;

class CityLimit
{
    private $value;

    public function __construct(int $value)
    {
        $this->setValue($value);
    }

    public function value():int
    {
        return $this->value;
    }

    private function setValue(int $value)
    {
        if(0 > $value) {
            throw new InvalidCitySizeException("City limit must be above 0");
        }
        $this->value = $value;
    }


}