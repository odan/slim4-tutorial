<?php

use Selective\Config\Configuration;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add global middleware to app
    $app->addRoutingMiddleware();

    // Catch exceptions and errors
    $app->add(ErrorMiddleware::class);
};
