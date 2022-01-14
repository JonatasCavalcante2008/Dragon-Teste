<?php


namespace App\Controles;


class Empresas extends Controle
{
    public function __construct($router)
    {
        parent::__construct ($router);
    }

    public function editar(array $data)
    {
        $empresa = (new \App\Regras\Empresas())->findById($data['id']);
        $R['id']       = $data['id'];
        $R['razao']    = $empresa->razao;
        $R['fantasia'] = $empresa->fantasia;
        $R['cnpj']     = Mask("##.###.###/####-##",$empresa->cnpj);

        echo json_encode ($R);
    }

    public function exec(array $data)
    {
        $R['error'] = false;

        if($data['tipo'] == 1) {
            $cnpj = preg_replace("/[^0-9]/", "", $data['cnpj']);
            $verif = (new \App\Regras\Empresas())->find('cnpj = :doc', "doc={$cnpj}")->fetch(true);
            if(!$verif) {
                $empresa           = new \App\Regras\Empresas();
                $empresa->razao    = $data['razao'];
                $empresa->fantasia = $data['fantasia'];
                $empresa->cnpj     = $cnpj;
                $empresa->save();
                $R['cad'] = true;
            }else{
                $R['error'] = true;
            }
        }

        if($data['tipo'] == 2) {
            $cnpj = preg_replace("/[^0-9]/", "", $data['cnpj']);

            $empresa = (new \App\Regras\Empresas())->findById($data['id']);
            $verif = (new \App\Regras\Empresas())->find('cnpj = :doc AND id != :id', "doc={$cnpj}&id={$data['id']}")->fetch(true);
            if(!$verif) {
                $empresa->razao = $data['razao'];
                $empresa->fantasia = $data['fantasia'];
                $empresa->cnpj = $cnpj;
                $empresa->save ();
                $R['alt'] = true;
            }else{
                $R['error'] = true;
            }
        }

        if($data['tipo'] == 3) {
            $empresa = (new \App\Regras\Empresas())->findById($data['id']);
            $empresa->destroy();
        }

        echo json_encode ($R);
    }
}