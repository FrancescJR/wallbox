<?php

declare(strict_types=1);

namespace Kata\Application\Service;

use Kata\Domain\City\City;
use Kata\Domain\City\ValueObject\CityLimit;

class CreateCityService
{
    public function execute(int $limitX, int $limitY): City
    {
        return new City(
            new CityLimit($limitX),
            new CityLimit($limitY)
        );
    }
}
