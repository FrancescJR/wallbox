<?php

declare(strict_types=1);

namespace Kata\Infrastructure\UI;


require __DIR__ . '../../../vendor/autoload.php';


use Kata\Application\UseCase\NavigateElectricVehiclesUseCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$containerBuilder = new ContainerBuilder();
$loader           = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('config/services.yaml');

/**@var $navigateElectricVehicleUseCase NavigateElectricVehiclesUseCase */
$navigateElectricVehicleUseCase = $containerBuilder->get('console.employee_list');

echo $navigateElectricVehicleUseCase->execute($argv[1]);


