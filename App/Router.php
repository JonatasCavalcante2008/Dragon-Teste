<?php

    use CoffeeCode\Router\Router;

    $router = new Router( SITE['root'] );
    $router->namespace("App\Controles");

    $router->group( null );
    $router->get(  "/" , "App:home", "app.home");
    $router->get(  "/login" , "Acesso:login", "acesso.login");
    $router->post( "/login/acesso" , "Acesso:acesso", "acesso.acesso");
    $router->get(  "/exit" , "App:logoff", "app.logoff");


    $router->get(  "/empresas" , "App:empresas", "app.empresas");
    $router->post(  "/empresas/editar" , "Empresas:editar", "empresas.editar");
    $router->post(  "/empresas/exec" , "Empresas:exec", "empresas.exec");

    $router->get(  "/colaboradores" , "App:colaboradores", "app.colaboradores");

    $router->post(  "/api" , "Api:api", "api.api");

    $router->group( "ops" );
    $router->get( "/{errcode}", "App:error404", "app.error404");

    $router->dispatch();

    if($router->error()){
        $router->redirect( "app.error404", ["errcode" => $router->error()]);
    }

