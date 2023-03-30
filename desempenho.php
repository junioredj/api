<?php


header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";

try
{
    $email = $_REQUEST['email'];
    
    $operacoes = Operacoes::getOperacoesByCliente($email);

    // echo($operacoes);

    $operacoes = json_decode($operacoes);

    $qtd_compra = 0;
    $qtd_venda = 0;
    $porcentagem_acerto = 0;
    $melhor_trade = 0;
    $pior_trade = 0;
    $reabaixamento_maximo = 0;
    $lucro_liquido = 0;
    $lucro_bruto = 0;
    $perda_bruta = 0;
    $qtd_op_vencedoras = 0;
    $qtd_op_perdedoras = 0;
    
    $total_pontos = 0;
    $lp_comprado = 0;
    $lp_vendido = 0;

    $sequencia_perda = 0;
    $total_operacoes = 0;
    $volume_negociado = 0;
    $pontos_qtd = 0;
    $dia_salvo = null;
    $qtd_dias_pregao = 0;
    $lucro_dia = 0;
    $dias_positivos = 0;

    $progresso_mes = array();


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

    $meses = array();

    $evolucao_patrimonial = array();

    foreach($operacoes as $operacao)
    {
        
        $dia = date("d", strtotime($operacao->dt_fechamento));
        if($dia != $dia_salvo)
        {
            if($lucro_dia > 0)
                $dias_positivos++;

            $dia_salvo = $dia;
            $qtd_dias_pregao++;
            $lucro_dia = 0;
            
        }

        $mes = date("m", strtotime($operacao->dt_fechamento));
        if($mes != $mes_salvo)
        {

            $mes_salvo = $mes;

            if($qtd_mes != 0)
            {
                array_push($meses, array("mes" => $mes_correspondente,
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

            array_push($evolucao_patrimonial, array("data" => $operacao->dt_fechamento, "profit" => $operacao->res_liq));


            //Soma o lucro do dia
            $lucro_dia +=  $operacao->res_liq;


            $volume_negociado += $operacao->qty_compra;        
            $volume_mes += $operacao->qty_compra;

            $total_operacoes++;
            $qtd_trades_mes++;

            //Verifica a operação é de compra ou venda
            if(strtolower($operacao->lado) == "v")
            {
                $qtd_venda++;
                $total_pontos += $operacao->preco_venda - $operacao->preco_compra;
                $pontos_mes += $operacao->preco_venda - $operacao->preco_compra;
                $lp_vendido += $operacao->res_liq;
                $pontos_qtd += ($operacao->preco_venda - $operacao->preco_compra) * $operacao->qty_compra;
                $inicio = new DateTime($operacao->dt_abertura);
                $fim = new DateTime($operacao->dt_fechamento);

                
    
            }
            else
            {
                $qtd_compra++;
                $total_pontos += $operacao->preco_compra - $operacao->preco_venda;
                $pontos_mes += $operacao->preco_compra - $operacao->preco_venda;
                $lp_comprado += $operacao->res_liq;
                $pontos_qtd += ($operacao->preco_compra - $operacao->preco_venda) * $operacao->qty_venda;
            
            }
            
            //Calcula o melhor trade
            if($operacao->res_liq > $melhor_trade)
                $melhor_trade = $operacao->res_liq;

            //Calcula o pior trade
            if($operacao->res_liq < $pior_trade)
                $pior_trade = $operacao->res_liq;
            
            //Verifica o rebaixamento máximo
            if($operacao->res_liq < 0)
                $sequencia_perda += $operacao->res_liq;
            else
                $sequencia_perda = 0;
            
            if($sequencia_perda < $reabaixamento_maximo)
                $reabaixamento_maximo = $sequencia_perda;
            
            //Verifica se o lucro da operação foi positivo
            if($operacao->res_liq > 0)
            {
                $qtd_op_vencedoras++;
                $qtd_op_vencedoras_mes++;

                $lucro_bruto += $operacao->res_liq;
                $lucro_bruto_mes += $operacao->res_liq;
            }
            
            //Verifica se o lucro da operação foi negativo
            if($operacao->res_liq < 0)
            {
                $qtd_op_perdedoras++;
                $perda_bruta += ($operacao->res_liq);
                $perda_bruta_mes += ($operacao->res_liq);
            }
        }
    
    }

    if($lucro_dia > 0)
        $dias_positivos++;
    
    if($qtd_mes > 0)
    {
        array_push($meses, array("mes" => $mes_correspondente,
                "lucro_liquido" => $lucro_bruto_mes + $perda_bruta_mes,
                "lucro_bruto" => $lucro_bruto_mes,
                "acerto" => ($qtd_op_vencedoras_mes > 0 && $qtd_trades_mes > 0)? (number_format(($qtd_op_vencedoras_mes / $qtd_trades_mes) * 100, 2, ",", ".")): 0,
                "fator_lucro" => ($perda_bruta_mes != 0)? number_format($lucro_bruto_mes / ($perda_bruta_mes * -1), 2, ",", "."): "0.00",
                "volume" => $volume_mes,
                "pontos" => $pontos_mes,
                "trades" => $qtd_trades_mes,
                ));
    }

    $dados['fator_lucro'] =                 ($perda_bruta != 0)? number_format($lucro_bruto / ($perda_bruta * -1), 2, ",", "."): "0.00";
    $dados['qtd_compra'] =                  $qtd_compra;
    $dados['qtd_venda'] =                   $qtd_venda;
    $dados['melhor_trade'] =                $melhor_trade;
    $dados['pior_trade'] =                  $pior_trade;
    $dados['rebaixamento_maximo'] =         $reabaixamento_maximo;
    $dados['lucro_bruto'] =                 $lucro_bruto;
    $dados['perda_bruta'] =                 $perda_bruta;
    $dados['lucro_liquido'] =               $lucro_bruto + $perda_bruta;
    $dados['qtd_op_vencedoras'] =           $qtd_op_vencedoras;
    $dados['qtd_op_perdedoras'] =           $qtd_op_perdedoras;
    $dados['total_operacoes'] =             $total_operacoes;
    $dados['pct_acerto'] =                  ($qtd_op_vencedoras > 0 && $total_operacoes > 0)? (number_format(($qtd_op_vencedoras / $total_operacoes) * 100, 2, ",", ".")): 0;
    $dados['pct_acerto_dia'] =              ($dias_positivos > 0 && $qtd_dias_pregao > 0)? (number_format(($dias_positivos / $qtd_dias_pregao) * 100, 2, ",", ".")): 0;
    $dados['total_pontos'] =                $total_pontos;
    $dados['media_trades'] =                ($total_operacoes > 0 && $total_pontos > 0)? ((($total_pontos / $total_operacoes) )): 0;
    $dados['media_ganho'] =                 ($lucro_bruto > 0 && $qtd_op_vencedoras > 0)? (number_format(($lucro_bruto / $qtd_op_vencedoras), 2, ",", ".")): 0;
    $dados['media_perda'] =                 ($qtd_op_perdedoras > 0)? (number_format(($perda_bruta / $qtd_op_perdedoras), 2, ",", ".")): 0;
    $dados['lp_comprado'] =                 number_format($lp_comprado, 2,  ",", ".");
    $dados['lp_vendido'] =                  number_format($lp_vendido, 2,  ",", ".");
    $dados['volume_negociado'] =            $volume_negociado;
    $dados['media_volume'] =                ($qtd_dias_pregao > 0)? number_format($volume_negociado / $qtd_dias_pregao, 2, ",", ""): "0.00";
    $dados['total_pontos_qtd'] =            number_format(($pontos_qtd), 2, ",", ".");
    $dados['media_pontos_trade'] =          ($total_operacoes > 0)? number_format($total_pontos / $total_operacoes, 2, ",", "."): "0.00";
    $dados['media_pontos_qtd'] =            ($total_operacoes >0)? (number_format(($pontos_qtd / $total_operacoes), 2, ",", ".")): "0.00";
    $dados['volume_posicao_media'] =        ($total_operacoes > 0)? number_format($volume_negociado / $total_operacoes, 2, ",",""): "0.00";
    $dados['qtd_pregao'] =                  $qtd_dias_pregao;
    $dados['dias_positivos'] =              $dias_positivos;
    $dados['media_dia_liq'] =               ($qtd_dias_pregao > 0)? number_format(($lucro_bruto + $perda_bruta) / $qtd_dias_pregao, 2, ",", ""): "0.00";
    $dados['media_dia_bruto'] =             ($qtd_dias_pregao > 0)? number_format(($lucro_bruto) / $qtd_dias_pregao, 2, ",", ""): "0.00";

    $dados['mes'] = $meses;
    $dados['evolucao_patrimonial'] =        $evolucao_patrimonial;


    echo json_encode($dados);


}
catch(Exception $erro)
{
    throw new Exception("Erro");
}


?>