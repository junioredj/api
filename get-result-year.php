<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";


    $email = $_REQUEST['email'];
    echo Operacoes::getOperacoesByClienteYear($email);

?>