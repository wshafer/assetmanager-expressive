<?php

namespace AssetManager\Expressive\MiddleWare;

use AssetManager\Core\Service\AssetManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

class AssetManagerMiddleware implements MiddlewareInterface
{
    protected $assetManager;

    public function __construct(AssetManager $assetManager)
    {
        $this->assetManager = $assetManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        if ($this->assetManager->resolvesToAsset($request)) {
            return $this->assetManager->setAssetOnResponse(new Response());
        }

        return $delegate->process($request);
    }
}
