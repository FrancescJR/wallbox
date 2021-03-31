<?php

require __DIR__ . '/vendor/autoload.php';


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Kata\Infrastructure\CLI\NavigateElectricVehiclesCLI;

$containerBuilder = new ContainerBuilder();
$loader           = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
$loader->load('config/services.yml');


/**@var $navigateElectricCLI NavigateElectricVehiclesCLI */
$navigateElectricCLI = $containerBuilder->get('infrastructure.io.navigate_electric_vehicles_cli');

$navigateElectricCLI->execute();
