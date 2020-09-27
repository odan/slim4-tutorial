<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->get('/users/{id}', \App\Action\UserReadAction::class)->setName('users-get');
    $app->post('/users', \App\Action\UserCreateAction::class)->setName('users-post');
};
