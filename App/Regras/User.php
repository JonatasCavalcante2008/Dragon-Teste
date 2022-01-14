<?php


namespace App\Regras;


use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct()
    {
        parent::__construct ('usuarios', [], 'id', false);
    }
}