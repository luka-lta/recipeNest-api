<?php

use RecipeNestApi\App\Factory\ContainerFactory;
use RecipeNestApi\Slim\SlimFactory;

require __DIR__ . '/../vendor/autoload.php';

try {
    $container = ContainerFactory::build();
    $app = SlimFactory::create($container);
    $app->run();
} catch (Throwable $throwable) {
    echo $throwable->getMessage();
}
