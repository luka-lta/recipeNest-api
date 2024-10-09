<?php

declare(strict_types=1);

namespace RecipeNestApi\App\Factory;

use DI\Container;
use DI\ContainerBuilder;
use RecipeNestApi\ApplicationConfig;

class ContainerFactory
{
    public static function build(): Container
    {
        $container = new ContainerBuilder();
        $container->useAutowiring(true);
        $container->addDefinitions(new ApplicationConfig());
        return  $container->build();
    }
}
