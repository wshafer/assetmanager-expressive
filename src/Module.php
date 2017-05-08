<?php

namespace AssetManager\Expressive;

class Module
{
    public function __invoke()
    {
        return require __DIR__.'/../config/module.config.php';
    }
}
