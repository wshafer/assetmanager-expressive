<?php
$coreConfig = \AssetManager\Core\Config\Config::getConfig();

$dependencies = [];
if (!empty($coreConfig['dependencies'])) {
    $dependencies = $coreConfig['dependencies'];
}

$assetManagerConfig = [];
if (!empty($coreConfig['asset_manager'])) {
    $assetManagerConfig = $coreConfig['asset_manager'];
}

return array(
    'dependencies' => $dependencies,
    'asset_manager' => $assetManagerConfig,
    'middleware_pipeline' => [
        'assetManager' => [
            'middleware' => [
                \AssetManager\Expressive\MiddleWare\AssetManagerMiddleware::class
                    => \AssetManager\Expressive\MiddleWare\AssetManagerMiddleware::class
            ],
            'priority' => -1000000,
        ],
    ],
);
