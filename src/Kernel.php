<?php

namespace Aatis;

use Aatis\DependencyInjection\Service\ContainerBuilder;

class Kernel
{
    public function handle(): void
    {
        $ctx = [
            'env' => 'dev',
        ];

        $container = (new ContainerBuilder($ctx, $_ENV['DOCUMENT_ROOT'] . '/../src'))->build();
    }
}
