<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";

    $dados = json_decode(file_get_contents('php://input'));



    $nome = trim($dados->nome);
    $email = trim($dados->email);
    $senha = trim($dados->password);

    echo Cliente::insertClient($email, $senha, $nome);



?>