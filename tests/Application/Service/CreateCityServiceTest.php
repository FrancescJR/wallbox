<?php

declare(strict_types=1);

namespace Kata\Tests\Application\Service;


use Kata\Application\Service\CreateCityService;
use PHPUnit\Framework\TestCase;

class CreateCityServiceTest extends TestCase
{
    public function testSuccess(): void
    {
        $service = new CreateCityService();

        $city = $service->execute(3,4);

        self::assertEquals(3, $city->getLimitX()->value());
        self::assertEquals(4, $city->getLimitY()->value());
        self::assertCount(0, $city->getVehicles());
    }

}