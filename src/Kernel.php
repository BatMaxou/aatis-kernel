<?php

namespace Aatis;

use Dotenv\Dotenv;
use Aatis\Routing\Service\Router;
use Aatis\DependencyInjection\Service\ContainerBuilder;

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

        /** @var Router $router */
        $router = $container->get(Router::class);

        $router->redirect();
    }
}
