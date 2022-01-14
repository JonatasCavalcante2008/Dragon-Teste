<?php


namespace App\Controles;


use App\Regras\User;
use League\Plates\Engine;

class Acesso
{
    protected $view;
    protected $router;

    public function __construct($router)
    {
        $this->router = $router;
        $this->view   = Engine::create(dirname(__DIR__). "/Paginas/", "php");
        $this->view->addData(["router" => $this->router]);

        if(!empty($_SESSION["login"])){
            $this->router->redirect("app.home");
        }
    }

    public function login()
    {
        echo $this->view->render ("login", []);
    }

    public function acesso(array $data)
    {

        $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
        $senha = filter_var($data['senha'], FILTER_DEFAULT);

        $user = (new User())->find('email = :e', "e={$email}")->fetch(true);

        if($user) {
            if (password_verify ($senha, $user[0]->senha)) {
                $_SESSION['login'] = true;
                $_SESSION['usuario'] = $user[0]->id;
                $R['url'] = $this->router->route ("app.home");
                $R['retorno'] = true;
            } else {
                $R['error'] = true;
            }
        }else{
            $R['error'] = true;
        }

        echo json_encode($R);
    }
}