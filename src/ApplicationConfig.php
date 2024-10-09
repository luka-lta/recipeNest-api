<?php

declare(strict_types=1);

namespace RecipeNestApi;

use DI\Definition\Source\DefinitionArray;
use Monolog\Logger;
use PDO;
use RecipeNestApi\App\Factory\LoggerFactory;
use RecipeNestApi\App\Factory\PDOFactory;

use function DI\factory;

class ApplicationConfig extends DefinitionArray
{
    public function __construct()
    {
        parent::__construct($this->getConfig());
    }

    private function getConfig(): array
    {
        return [
            Logger::class => factory(new LoggerFactory()),
            PDO::class => factory(new PdoFactory()),
        ];
    }
}
