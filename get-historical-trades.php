<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";

try
{
    $email = $_REQUEST['email'];
    
    $operacoes = Operacoes::getOperacoesByCliente($email);

    $operacoes = json_decode($operacoes);

    //
    //          VARIAVEIS DE CONTROLE DO MES
    //
    $mes_salvo = null;
    $qtd_mes = 0;
    $lucro_bruto_mes = 0;
    $perda_bruta_mes = 0;
    $volume_mes = 0;
    $pontos_mes = 0;
    $qtd_trades_mes = 0;
    $qtd_op_vencedoras_mes = 0;
    $mes_correspondente = null;
    $chart_liquido_mes = array();
    $chart_data_mes = array();
    $chart_bruto_mes = array();

    $meses = array();

    //
    //          VARIAVEIS DE CONTROLE DO DIA
    //
    $dia_salvo = null;
    $qtd_dia = 0;
    $lucro_bruto_dia = 0;
    $perda_bruta_dia = 0;
    $volume_dia = 0;
    $pontos_dia = 0;
    $qtd_trades_dia = 0;
    $qtd_op_vencedoras_dia = 0;
    $dia_correspondente = null;
    $dias = array();

    $evolucao_patrimonial = array();

    foreach($operacoes as $operacao)
    {
        
        $dia = date("d", strtotime($operacao->dt_fechamento));
        if($dia != $dia_salvo)
        {

            $dia_salvo = $dia;

            if($qtd_dia != 0)
            {
                array_push($dias, array("label" => $dia_correspondente,
                "lucro_liquido" => $lucro_bruto_dia + $perda_bruta_dia,
                "lucro_bruto" => $lucro_bruto_dia,
                "acerto" => ($qtd_op_vencedoras_dia > 0 && $qtd_trades_dia > 0)? (number_format(($qtd_op_vencedoras_dia / $qtd_trades_dia) * 100, 2, ",", ".")): 0,
                "fator_lucro" => ($perda_bruta_dia != 0)? number_format($lucro_bruto_dia / ($perda_bruta_dia * -1), 2, ",", "."): "0.00",
                "volume" => $volume_dia,
                "pontos" => $pontos_dia,
                "trades" => $qtd_trades_dia,
                ));
            }


            $qtd_dia++;
            $dia_correspondente = date("Y-m-d", strtotime($operacao->dt_fechamento));
            $lucro_bruto_dia = 0;
            $perda_bruta_dia = 0;
            $volume_dia = 0;
            $pontos_dia = 0;
            $qtd_trades_dia = 0;
            $qtd_op_vencedoras_dia = 0;
            
        }

        $mes = date("m", strtotime($operacao->dt_fechamento));
        if($mes != $mes_salvo)
        {

            $mes_salvo = $mes;

            if($qtd_mes != 0)
            {
                array_push($chart_liquido_mes, $lucro_bruto_mes + $perda_bruta_mes);
                array_push($chart_bruto_mes, $lucro_bruto_mes);
                array_push($chart_data_mes, $mes_correspondente);

                array_push($meses, array("label" => $mes_correspondente,
                "lucro_liquido" => $lucro_bruto_mes + $perda_bruta_mes,
                "lucro_bruto" => $lucro_bruto_mes,
                "acerto" => ($qtd_op_vencedoras_mes > 0 && $qtd_trades_mes > 0)? (number_format(($qtd_op_vencedoras_mes / $qtd_trades_mes) * 100, 2, ",", ".")): 0,
                "fator_lucro" => ($perda_bruta_mes != 0)? number_format($lucro_bruto_mes / ($perda_bruta_mes * -1), 2, ",", "."): "0.00",
                "volume" => $volume_mes,
                "pontos" => $pontos_mes,
                "trades" => $qtd_trades_mes,
                ));
            }

            $qtd_mes++;
            $mes_correspondente = date("Y-m", strtotime($operacao->dt_fechamento));
            $lucro_bruto_mes = 0;
            $perda_bruta_mes = 0;
            $volume_mes = 0;
            $pontos_mes = 0;
            $qtd_trades_mes = 0;
            $qtd_op_vencedoras_mes = 0;
            
        }

        //Verifica se a operação está fechada
        if($operacao->qty_compra == $operacao->qty_venda)
        {
     
            $volume_dia += $operacao->qty_compra;
            $volume_mes += $operacao->qty_compra;

            $qtd_trades_dia++;
            $qtd_trades_mes++;

            //Verifica a operação é de compra ou venda
            if(strtolower($operacao->lado) == "v")
            {
                $pontos_dia += $operacao->preco_venda - $operacao->preco_compra;
                $pontos_mes += $operacao->preco_venda - $operacao->preco_compra;


                
    
            }
            else
            {
                $pontos_dia += $operacao->preco_compra - $operacao->preco_venda;
                $pontos_mes += $operacao->preco_compra - $operacao->preco_venda;
            
            }
            
            
            //Verifica se o lucro da operação foi positivo
            if($operacao->res_liq > 0)
            {
                $qtd_op_vencedoras_dia++;
                $qtd_op_vencedoras_mes++;

                $lucro_bruto_dia += $operacao->res_liq;
                $lucro_bruto_mes += $operacao->res_liq;
            }
            
            //Verifica se o lucro da operação foi negativo
            if($operacao->res_liq < 0)
            {
                $perda_bruta_dia += ($operacao->res_liq);
                $perda_bruta_mes += ($operacao->res_liq);
            }
        }
    
    }

    
    if($qtd_mes > 0)
    {
        array_push($chart_liquido_mes,$lucro_bruto_mes + $perda_bruta_mes);
        array_push($chart_bruto_mes, $lucro_bruto_mes);
        array_push($chart_data_mes, $mes_correspondente);

        array_push($meses, array("label" => $mes_correspondente,
                "lucro_liquido" => $lucro_bruto_mes + $perda_bruta_mes,
                "lucro_bruto" => $lucro_bruto_mes,
                "acerto" => ($qtd_op_vencedoras_mes > 0 && $qtd_trades_mes > 0)? (number_format(($qtd_op_vencedoras_mes / $qtd_trades_mes) * 100, 2, ",", ".")): 0,
                "fator_lucro" => ($perda_bruta_mes != 0)? number_format($lucro_bruto_mes / ($perda_bruta_mes * -1), 2, ",", "."): "0.00",
                "volume" => $volume_mes,
                "pontos" => $pontos_mes,
                "trades" => $qtd_trades_mes,
                ));
    }

    if($qtd_dia)
    {
        array_push($dias, array("label" => $dia_correspondente,
            "lucro_liquido" => $lucro_bruto_dia + $perda_bruta_dia,
            "lucro_bruto" => $lucro_bruto_dia,
            "acerto" => ($qtd_op_vencedoras_dia > 0 && $qtd_trades_dia > 0)? (number_format(($qtd_op_vencedoras_dia / $qtd_trades_dia) * 100, 2, ",", ".")): 0,
            "fator_lucro" => ($perda_bruta_dia != 0)? number_format($lucro_bruto_dia / ($perda_bruta_dia * -1), 2, ",", "."): "0.00",
            "volume" => $volume_dia,
            "pontos" => $pontos_dia,
            "trades" => $qtd_trades_dia,
            ));
    }


    $dados['mes'] = $meses;
    $dados['dia'] = $dias;
    $dados['chart']['liquido'] = $chart_liquido_mes;
    $dados['chart']['data'] = $chart_data_mes;
    $dados['chart']['bruto'] = $chart_bruto_mes;


    echo json_encode($dados);


}
catch(Exception $erro)
{
    throw new Exception("Erro");
}


?>