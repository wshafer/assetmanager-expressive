<?php

namespace AssetManager;

class Module
{
    public function __invoke()
    {
        return require __DIR__.'/../../config/expressive.config.php';
    }
}
