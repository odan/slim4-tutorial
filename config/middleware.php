<?php

use Selective\Config\Configuration;
use Slim\App;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add global middleware to app
    $app->addRoutingMiddleware();

    $container = $app->getContainer();

    // Error handler
    $settings = $container->get('settings')['error_handler_middleware'];
    $displayErrorDetails = (bool)$settings['display_error_details'];
    $logErrors = (bool)$settings['log_errors'];
    $logErrorDetails = (bool)$settings['log_error_details'];

    $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);
};
