<?php

namespace AssetManager\Expressive\MiddleWare;

use AssetManager\Core\Service\AssetManager;
use Psr\Container\ContainerInterface;

class AssetManagerMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new AssetManagerMiddleware(
            $container->get(AssetManager::class)
        );
    }
}
