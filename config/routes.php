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
    });

    /**
     * GET	    Selection de plusieurs usagers
     */
    $app->group('/users', function (RouteCollectorProxy $group) {
        $group->get('', \App\Action\UserReadAction::class);
    });

    /**
     * GET	   	Lister seulement l'usager avec le id en paramètre
     * PUT	   	Modifier l'usager avec le id en paramètre
     * DELETE	Supprimer l'usager avec le id en paramètre
     */
     $app->group('/user', function (RouteCollectorProxy $group) {

         // FIXME: Fonctionne seulement avec tout les champ user fournis
         $group->put('', \App\Action\UserUpdateAction::class);
         
         $group->delete('', \App\Action\UserDeleteAction::class);
     });


};

