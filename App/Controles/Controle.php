<?php


namespace App\Controles;

use App\Regras\User;
use League\Plates\Engine;
use CoffeeCode\Router\Router;
use CoffeeCode\DataLayer\DataLayer;

abstract class Controle
{
    protected $view;
    protected $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->view = Engine::create (dirname (__DIR__) . "/Paginas/", "php");
        $this->view->addData (["router" => $this->router]);

        if(!isset($_SESSION["login"])) {
            $this->router->redirect("acesso.login");
        }

        $user = (new User())->findById ($_SESSION['usuario']);

        $this->view->addData (["usuario" => $user]);
    }
}