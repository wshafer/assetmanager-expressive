<?php

namespace AssetManager\Expressive\Test\Middleware;

use AssetManager\Core\Service\AssetManager;
use AssetManager\Expressive\MiddleWare\AssetManagerMiddleware;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

/**
 * @covers \AssetManager\Expressive\MiddleWare\AssetManagerMiddleware
 */
class AssetManagerMiddlewareTest extends TestCase
{
    /** @var AssetManagerMiddleware */
    protected $middleware;

    /** @var \PHPUnit_Framework_MockObject_MockObject|AssetManager */
    protected $mockAssetManger;

    /** @var \PHPUnit_Framework_MockObject_MockObject|DelegateInterface */
    protected $mockDelegate;

    /** @var \PHPUnit_Framework_MockObject_MockObject|ServerRequestInterface */
    protected $mockRequest;

    public function setup()
    {
        $this->mockAssetManger = $this->getMockBuilder(AssetManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mockDelegate = $this->createMock(DelegateInterface::class);

        $this->mockRequest = $this->createMock(ServerRequestInterface::class);

        $this->middleware = new AssetManagerMiddleware($this->mockAssetManger);

        $this->assertInstanceOf(AssetManagerMiddleware::class, $this->middleware);
    }

    public function testConstructor()
    {
    }

    public function testProcessReturnsResponse()
    {
        $this->mockDelegate->expects($this->never())
            ->method('process');

        $this->mockAssetManger->expects($this->once())
            ->method('resolvesToAsset')
            ->with($this->mockRequest)
            ->willReturn(true);

        $this->mockAssetManger->expects($this->once())
            ->method('setAssetOnResponse')
            ->will($this->returnArgument(0));

        $result = $this->middleware->process($this->mockRequest, $this->mockDelegate);

        $this->assertInstanceOf(Response::class, $result);
    }

    public function testProcessContinuesChain()
    {
        $this->mockDelegate->expects($this->once())
            ->method('process')
            ->willReturn(true);

        $this->mockAssetManger->expects($this->once())
            ->method('resolvesToAsset')
            ->with($this->mockRequest)
            ->willReturn(false);

        $this->mockAssetManger->expects($this->never())
            ->method('setAssetOnResponse');

        $result = $this->middleware->process($this->mockRequest, $this->mockDelegate);

        $this->assertTrue($result);
    }
}
