<?php

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    
    require_once "autoload.php";


    if(isset($_REQUEST['email']) && !empty($_REQUEST['email']))
    {

        $email = trim($_REQUEST['email']);
        echo Operacoes::getOperacoesByCliente($email);
    }
?>