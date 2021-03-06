<?php

declare(strict_types=1);

namespace Kata\Stubs\Domain\City;


use Kata\Domain\City\City;
use Kata\Stubs\Domain\City\ValueObject\CityLimitStub;

class CityStub
{
    public static function create(int $positionX, int $positionY): City
    {
        return new City(
            CityLimitStub::create($positionX),
            CityLimitStub::create($positionY)
        );
    }

    public static function random(): City
    {
        return new City(
            CityLimitStub::random(),
            CityLimitStub::random()
        );
    }


}