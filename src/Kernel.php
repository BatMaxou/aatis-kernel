<?php

namespace Aatis;

use Aatis\DependencyInjection\Exception\ServiceNotFoundException;
use Aatis\DependencyInjection\Service\ContainerBuilder;
use Aatis\ErrorHandler\Service\ErrorCodeBag;
use Aatis\ErrorHandler\Service\ErrorHandler;
use Aatis\ErrorHandler\Service\ExceptionCodeBag;
use Aatis\HttpFoundation\Component\Request;
use Aatis\Logger\Service\Logger;
use Aatis\Routing\Service\Router;
use Dotenv\Dotenv;

class Kernel
{
    public function handle(Request $request): void
    {
        /** @var string|null $documentRoot */
        $documentRoot = $request->server->get('DOCUMENT_ROOT');

        $dotenv = Dotenv::createImmutable(sprintf('%s../../', $documentRoot), ['.env', '.env.local'], false);
        $dotenv->load();

        $ctx = array_merge(
            array_diff_key($_SERVER, $request->server->all()),
            ['APP_DOCUMENT_ROOT' => $documentRoot ?? '']
        );

        $container = (new ContainerBuilder($ctx))->build();

        try {
            /** @var Logger $logger */
            $logger = $container->get(Logger::class);
        } catch (ServiceNotFoundException) {
            $logger = null;
        } catch (\Exception $e) {
            throw $e;
        }

        /** @var ErrorCodeBag $errorCodeBag */
        $errorCodeBag = $container->get(ErrorCodeBag::class);

        /** @var ExceptionCodeBag */
        $exceptionCodeBag = $container->get(ExceptionCodeBag::class);

        ErrorHandler::initialize($errorCodeBag, $exceptionCodeBag, $logger);

        /** @var Router $router */
        $router = $container->get(Router::class);

        $router->redirect($request)
            ->prepare($request)
            ->send()
        ;
    }
}
