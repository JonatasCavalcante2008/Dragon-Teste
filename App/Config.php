<?php
    $pasta = explode('/',$_SERVER['REQUEST_URI']);

    define("SITE",[
            "name"   => "Pedidos",
            "domain" => "http://pedidos.com.br",
            "locale" => "pt_BR",
            "root"   => "http://localhost/".$pasta[1]
    ]);

    define("DATA_LAYER_CONFIG", [
        "driver" => "mysql",
        "host" => "db4free.net",
        "port" => "3306",
        "dbname" => 'dragonteste',
        "username" => "userdragon",
        "passwd" => "dragon3355",
        "options" => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_NATURAL
        ]
    ]);