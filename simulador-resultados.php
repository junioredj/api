<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";

    $data = $_REQUEST['date'];
    $tag = $_REQUEST['tag'];
    $tipo = $_REQUEST['type'];
    $lado = $_REQUEST['lado'];
    $codigo = $_REQUEST['codigo'];
    $email = $_REQUEST['email'];



    if($lado == "ambos")
        $lado = "";
    else if($lado == "compra")
        $lado = "C";
    else 
        $lado = "V";
    


    if($tipo == "day-trader")
        $tipo = 'true';
    else if($tipo == "swing-trader")
        $tipo = 'false';
    else
        $tipo = 'nenhum';

    $data_hitorico = 0;
    if($data == "hoje")
        $data_historico = date('Y-m-d');
    else if($data == "ontem")
        $data_historico = date('Y-m-d', strtotime("-1 days",strtotime(date('Y-m-d'))));
    else if($data == "sete-dias")
        $data_historico = date('Y-m-d', strtotime("+7 days",strtotime(date('Y-m-d'))));
    else if($data == "trinta-dias")
        $data_historico = date('Y-m-d', strtotime("+30 days",strtotime(date('Y-m-d'))));
    else if($data == "mes")
        $data_historico = date('Y-m-d', strtotime(date('Y-m-1')));
    else if($data == "mes-anterior")
        $data_historico = date('Y-m-d', strtotime(date('Y-m-1')));
    else if($data == "ano")
        $data_historico = date('Y-m-d', strtotime(date('Y-1-1')));
    else if($data == "tudo")
        $data_historico = 0;

    $operacoes = json_decode(Operacoes::getOperacoesByClienteSimulator($email, $tag, $lado, $tipo, $codigo, $data_historico));

    $evolucao_patrimonial = array();
    foreach($operacoes as $operacao)
    {
        array_push($evolucao_patrimonial, $operacao->res_liq);
    }

    $dados['chart_lucro']["data"] = $evolucao_patrimonial;
    $dados['trades'] = $operacoes;
    echo json_encode($dados);



?>