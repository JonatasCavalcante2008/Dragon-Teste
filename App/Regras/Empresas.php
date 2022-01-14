<?php


namespace App\Regras;


use CoffeeCode\DataLayer\DataLayer;

class Empresas extends DataLayer
{
    public function __construct()
    {
        parent::__construct ('empresas', [], 'id', false);
    }
}