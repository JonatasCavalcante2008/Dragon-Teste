<?php


namespace App\Controles;

use App\Controles\Controle;
use App\Regras\User;
use App\Regras\Empresas;

class App extends Controle
{
    public function __construct($router)
    {
        parent::__construct ($router);
    }

    public function home()
    {
        echo $this->view->render("home",[]);
    }

    public function empresas()
    {
        $empresas = (new Empresas())->find()->fetch(true);

        if($empresas) {
            foreach ($empresas as $val) {
                $emp[] = [$val->id, $val->razao, $val->fantasia, Mask ("##.###.###/####-##", $val->cnpj),
                    "<button class='btn btn-primary btnEditar mr-2 br-50' data-toggle='tooltip' data-placement='top' data-original-title='Editar' data-id='" . $val->id . "' data-tipo='2'>
                          <i class='fa fa-edit'></i>
                       </button> 
                       <button class='btn btn-danger btnExec br-50' data-toggle='tooltip' data-placement='top' data-original-title='Excluir' data-id='" . $val->id . "' data-tipo='3'>
                          <i class='fa fa-trash'></i>
                       </button>"
                ];
            }
            $emp = json_encode ($emp);
        }else{
            $emp = null;
        }

        echo $this->view->render("empresas",[
            'emp' => $emp
        ]);
    }

    public function logoff()
    {
        unset($_SESSION['login']);
        session_destroy();
        $this->router->redirect('acesso.login');
    }

    public function error404()
    {
        echo $this->view->render("error",[]);
    }

}