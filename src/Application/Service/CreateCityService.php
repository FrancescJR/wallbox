<?php

declare(strict_types=1);

namespace Kata\Application\Service;

use Kata\Domain\City\City;
use Kata\Domain\City\Exception\InvalidCitySizeException;
use Kata\Domain\City\ValueObject\CityLimit;

class CreateCityService
{
    /**
     * @param int $limitX
     * @param int $limitY
     * @return City
     * @throws InvalidCitySizeException
     */
    public function execute(int $limitX, int $limitY): City
    {
        return new City(
            new CityLimit($limitX),
            new CityLimit($limitY)
        );
    }
}
