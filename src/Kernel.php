<?php

namespace Aatis;

use Dotenv\Dotenv;
use Aatis\Routing\Service\Router;
use Aatis\ErrorHandler\Service\ErrorHandler;
use Aatis\DependencyInjection\Service\ContainerBuilder;
use Aatis\ErrorHandler\Service\ErrorCodeBag;
use Aatis\ErrorHandler\Service\ExceptionCodeBag;
use Aatis\Logger\Service\Logger;

class Kernel
{
    public function handle(): void
    {
        $server = $_SERVER;

        $dotenv = Dotenv::createImmutable($server['DOCUMENT_ROOT'].'../../', ['.env', '.env.local'], false);
        $dotenv->load();

        $ctx = array_merge(
            array_diff_key($_SERVER, $server),
            $server['DOCUMENT_ROOT'] ? ['APP_DOCUMENT_ROOT' => $server['DOCUMENT_ROOT']] : []
        );

        $container = (new ContainerBuilder($ctx))->build();

        /** @var Logger $logger */
        $logger = $container->get(Logger::class);

        /** @var ErrorCodeBag $errorCodeBag */
        $errorCodeBag = $container->get(ErrorCodeBag::class);

        /** @var ExceptionCodeBag */
        $exceptionCodeBag = $container->get(ExceptionCodeBag::class);

        ErrorHandler::initialize($logger, $errorCodeBag, $exceptionCodeBag);

        /** @var Router $router */
        $router = $container->get(Router::class);

        $router->redirect();
    }
}
