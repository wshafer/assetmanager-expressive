<?php

namespace AssetManager\Expressive\Test\Middleware;

use AssetManager\Core\Service\AssetManager;
use AssetManager\Expressive\MiddleWare\AssetManagerMiddleware;
use AssetManager\Expressive\MiddleWare\AssetManagerMiddlewareFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @covers \AssetManager\Expressive\MiddleWare\AssetManagerMiddlewareFactory
 */
class AssetManagerMiddlewareFactoryTest extends TestCase
{
    public function testInvoke()
    {
        $container = $this->createMock(ContainerInterface::class);
        $assetManager = $this->getMockBuilder(AssetManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $container->expects($this->once())
            ->method('get')
            ->with(AssetManager::class)
            ->willReturn($assetManager);

        $factory = new AssetManagerMiddlewareFactory();

        $result = $factory($container);

        $this->assertInstanceOf(AssetManagerMiddleware::class, $result);
    }
}
