<?php

declare(strict_types=1);

namespace Kata\Stubs\Domain\City\ValueObject;

use Kata\Domain\City\ValueObject\CityLimit;

class CityLimitStub
{
    public static function create(int $limit):CityLimit
    {
        return new CityLimit($limit);
    }

    public static function random():CityLimit
    {
        return self::create(rand(0,50));
    }

}