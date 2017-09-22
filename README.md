[![codecov](https://codecov.io/gh/wshafer/assetmanager-expressive/branch/master/graph/badge.svg)](https://codecov.io/gh/wshafer/assetmanager-expressive)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wshafer/assetmanager-expressive/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wshafer/assetmanager-expressive/?branch=master)
[![Build Status](https://travis-ci.org/wshafer/assetmanager-expressive.svg?branch=master)](https://travis-ci.org/wshafer/assetmanager-expressive)

# AssetManager For Zend Expressive
Fork of the original [ZF2 Assetmanager](https://github.com/RWOverdijk/AssetManager) 
By [Wesley Overdijk](http://blog.spoonx.nl/) and [Marco Pivetta](http://ocramius.github.com/)
for use with Zend Expressive

## Introduction
This module provides functionality to load assets and static files from your module directories 
through simple configuration. This allows you to avoid having to copy your files over to the `public/` 
directory, and makes usage of assets very similar to what already is possible with view scripts, 
which can be overridden by other modules. In a nutshell, this module allows you to package assets 
with your module working *out of the box*.

## Installation

 1.  Require assetmanager:

```sh
composer require wshafer/assetmanager-expressive
```

## Usage

Take a look at the **[wiki](https://github.com/wshafer/assetmanager-core/wiki)** for a quick start and more information.
A lot, if not all of the topics, have been covered in-dept there.

**Sample module config:**

```php
<?php
return array(
    'asset_manager' => array(
        'resolver_configs' => array(
            'collections' => array(
                'js/d.js' => array(
                    'js/a.js',
                    'js/b.js',
                    'js/c.js',
                ),
            ),
            'paths' => array(
                __DIR__ . '/some/particular/directory',
            ),
            'map' => array(
                'specific-path.css' => __DIR__ . '/some/particular/file.css',
            ),
        ),
        'filters' => array(
            'js/d.js' => array(
                array(
                    // Note: You will need to require the classes used for the filters yourself.
                    'filter' => 'JSMin',
                ),
            ),
        ),
        'view_helper' => array(
            'cache'            => 'Application\Cache\Redis', // You will need to require the factory used for the cache yourself.
            'append_timestamp' => true,                      // optional, if false never append a query param
            'query_string'     => '_',                       // optional
        ),
        'caching' => array(
            'js/d.js' => array(
                'cache'     => 'Apc',
            ),
        ),
    ),
);
```

*Please be careful, since this module will serve every file as-is, including PHP code.*

## Questions / support
If you're having trouble with the asset manager there are a couple of resources that might be of help.
* The [FAQ wiki page](https://github.com/wshafer/assetmanager-core/wiki/FAQ), where you'll perhaps find your answer.
* [Issue tracker](https://github.com/wshafer/assetmanager-core/issues). (Please try to not submit unrelated issues).

