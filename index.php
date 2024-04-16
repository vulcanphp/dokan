<?php

use VulcanPhp\Core\Foundation\Application;
use VulcanPhp\FastCache\SiteCache;

// define root directory of the application
define('ROOT_DIR', __DIR__);

// register the composer auto loader
require_once __DIR__ . '/vendor/autoload.php';

// create a new application instance for this http request
Application::create(__DIR__)
    ->registerKernel(App\Http\Kernels\AppKernel::class)
    ->run();

// stop the application execution process
exit;
