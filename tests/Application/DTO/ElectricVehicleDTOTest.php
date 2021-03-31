<?php

declare(strict_types=1);

namespace Kata\Tests\Application\DTO;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use PHPUnit\Framework\TestCase;

class ElectricVehicleDTOTest extends TestCase
{
    public function testCreateFromObject(): void
    {
        $electricVehicle = ElectricVehicleStub::random();

        $evDTO = ElectricVehicleDTO::creteFromElectiveVehicle($electricVehicle);

        self::assertEquals($electricVehicle->getCityPosition()->getPositionX(), $evDTO->positionX);
        self::assertEquals($electricVehicle->getCityPosition()->getPositionY(), $evDTO->positionY);
        self::assertEquals($electricVehicle->getDirection()->value(), $evDTO->direction);
    }

}