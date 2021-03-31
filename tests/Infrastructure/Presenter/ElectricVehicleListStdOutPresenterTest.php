<?php

declare(strict_types=1);

namespace Kata\Tests\Infrastructure\Presenter;


use Kata\Application\DTO\ElectricVehicleDTO;
use Kata\Infrastructure\Presenter\ElectricVehicleListStdOutPresenter;
use PHPUnit\Framework\TestCase;

class ElectricVehicleListStdOutPresenterTest extends TestCase
{
    public function testSuccess():void
    {
        $list = [
            new ElectricVehicleDTO(1,2,"N"),
            new ElectricVehicleDTO(2,3,"S")
        ];

        $expectedResult = [
            '1 2 N',
            '2 3 S'
        ];

        $presenter = new ElectricVehicleListStdOutPresenter();

        $representation = $presenter->write($list);

        self::assertEquals($expectedResult, $representation);
    }

}