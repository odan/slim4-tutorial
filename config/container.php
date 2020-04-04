<?php

use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Optional: Set the base path to run the app in a subdirectory.
        $app->setBasePath('/slim4-tutorial');

        return $app;
    },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error_handler_middleware'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get('settings');

        $host = $settings['db']['host'];
        $dbname = $settings['db']['database'];
        $username = $settings['db']['username'];
        $password = $settings['db']['password'];
        $charset = $settings['db']['charset'];
        $flags = $settings['db']['flags'];
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $flags);
    },

];
