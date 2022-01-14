<?php


namespace App\Controles;


class Conexao extends Controle
{
    private static $conn;

    public static function Mysql()
    {
        try {
            $conn = new \PDO('mysql:host=localhost;dbname=pedidoscr2', 'root', '');
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch(\PDOException $e) {
            $mensagem = "\nErro: " . $e->getMessage();
            throw new \Exception($mensagem);
        }
    }
}