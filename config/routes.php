<?php

use App\Middleware\BasicAuthMiddleware;
use Slim\Routing\RouteCollectorProxy;
use Slim\App;

return function (App $app) {

    //Test
    $app->get('/test',  \App\Action\HomeAction::class)->setName('Tests');

    // Documentation de l'api
    $app->get('/docs', \App\Action\Docs\SwaggerUiAction::class);
    $app->get('/', \App\Action\Docs\SwaggerUiAction::class)->setName('Docs');


    /**
     * GET	    Selection dun usager
     * POST	    Insertion d'un usager
     */
    $app->group('/user', function (RouteCollectorProxy $group) {
        $group->get('/{id:[0-9]+}', \App\Action\UserReadAction::class);
        $group->post('', \App\Action\UserCreateAction::class);
        $group->put('/{id:[0-9]+}', \App\Action\UserUpdateAction::class);
        $group->delete('/{id:[0-9]+}', \App\Action\UserDeleteAction::class);
    });

    /**
     * GET	    Selection de plusieurs usagers
     */
    $app->group('/users', function (RouteCollectorProxy $group) {
        $group->get('', \App\Action\UserReadAction::class);
    });


};

