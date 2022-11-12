<?php

use App\Controller\CalculateController;
use App\Service\Calculator;
use App\Service\TariffsManager;
use App\Service\TemplateManager;

spl_autoload_register(function ($class) {
    $explodedClass = explode('\\', $class);
    unset($explodedClass[0]);
    $path = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $explodedClass) . '.php';
    if (file_exists($path)) {
        require $path;
    }
});

$tariffsManager = new TariffsManager();
$calculator = new Calculator();
$templateManager = new TemplateManager();
$controller = new CalculateController($calculator, $tariffsManager, $templateManager);
$controller();
