

<?php


    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
     header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";

    $dados = json_decode(file_get_contents('php://input'));

    

    $email = trim($dados->email);
    $senha = trim($dados->password);

    if(!empty($email) && !empty($senha))
    {
        $retorno = (Cliente::login($email, $senha));
        $json = json_decode($retorno);
        if($json->login == "true")
        {
            echo $retorno;
        }
        else
        {
            echo $retorno;
            new Error("erro", 400);
        }
    }
    else
    {
        new Error("erro", 400);
    }


    
    



?>