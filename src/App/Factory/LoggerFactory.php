<?php

declare(strict_types=1);

namespace RecipeNestApi\App\Factory;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LogLevel;

class LoggerFactory
{
    public function __invoke(): Logger
    {
        $logger = new Logger('RecipeNestApi');
        $logger->pushHandler(new StreamHandler('/app/logs/logger.log', LogLevel::ERROR));

        return $logger;
    }
}
