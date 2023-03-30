<?php

use function PHPSTORM_META\type;

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header('Content-Type: application/json; charset=utf-8');

    require_once "autoload.php";


    $dados = json_decode(file_get_contents('php://input'));

    //echo gettype($dados);
    if(isset($dados->nome))
    {
        $nome = trim($dados->nome) ." " . trim($dados->surname); 
        $senha = trim($dados->password);
        $email = trim($dados->email);
        
        echo Cliente::updateCliente($email, $senha, $nome);
        
    }
    else
    json_encode(array("update" => "false"));

    
  
?>