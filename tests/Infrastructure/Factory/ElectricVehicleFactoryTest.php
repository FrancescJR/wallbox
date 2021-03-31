<?php

declare(strict_types=1);

namespace Kata\Tests\Infrastructure\Factory;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Infrastructure\Factory\ElectricVehicleFactory;
use Kata\Stubs\Domain\ElectricVehicle\ElectricVehicleStub;
use PHPUnit\Framework\TestCase;

class ElectricVehicleFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $factory = new ElectricVehicleFactory();

        $electricVehicle = ElectricVehicleStub::random();

        $electricVehicleDTO = ElectricVehicleDTO::creteFromElectiveVehicle($electricVehicle);

        $factoryElectricVehicle = $factory->createFromPO($electricVehicleDTO);

        self::assertEquals($electricVehicle, $factoryElectricVehicle);
    }

}