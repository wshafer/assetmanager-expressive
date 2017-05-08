<?php

namespace AssetManager\Expressive\MiddleWare;

use AssetManager\Core\Service\AssetManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AssetManagerMiddleware
{
    protected $assetManager;

    public function __construct(AssetManager $assetManager)
    {
        $this->assetManager = $assetManager;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next = null
    ) {

        if ($this->assetManager->resolvesToAsset($request)) {
            return $this->assetManager->setAssetOnResponse($response);
        }

        if (!$next) {
            return $response;
        }

        return $next($request, $response);
    }
}
