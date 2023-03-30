<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";

try
{
    $email = $_REQUEST['email'];
    echo Operacoes::geEvolucaoPatrimonial($email);
}
catch(Exception $erro)
{
    throw new Exception("Erro");
}

?>