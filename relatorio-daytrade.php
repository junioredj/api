<?php

    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');

    require_once "autoload.php";


    try
    {
        $email = $_REQUEST['email'];
        $operacoes = Operacoes::getOperacoesDayTradeByCliente($email);
        $operacoes = json_decode($operacoes);

        $lucro_liquido = 0;
        $lucro_bruto = 0;
        $perda_bruta = 0;
        $fator_lucro = 0;
        $pct_acerto = 0;
        $total_trades = 0;
        $media_liq_trade = 0;
        $volume_total = 0;
        $qtd_acertos = 0;
        $qtd_perdas = 0;

        $qtd_compra = 0;
        $qtd_venda = 0;

        $lucro_liquido_trade = array();
        $pontos_por_trade = array();
        $trades = array();
        $trades_realizados = array();

        foreach($operacoes as $operacao)
        {
            if($operacao->qty_venda == $operacao->qty_compra)
            {
                array_push($lucro_liquido_trade, $operacao->res_liq);
                array_push($trades, $operacao->res_liq);
                array_push($trades_realizados, array("lucro" => $operacao->res_liq, "ativo" => $operacao->codigo));

                //Verifica a operação é de compra ou venda
                if(strtolower($operacao->lado) == "v")
                {
                    $qtd_venda++;
                    array_push($pontos_por_trade, $operacao->preco_venda - $operacao->preco_compra);
                }
                else
                {
                    $qtd_compra++;
                    array_push($pontos_por_trade, $operacao->preco_venda - $operacao->preco_compra);
                }

                if($operacao->res_liq > 0)
                {
                    $lucro_bruto += $operacao->res_liq;
                    $qtd_acertos++;
                }
                else
                {
                    $perda_bruta += $operacao->res_liq;
                    $qtd_perdas++;
                }
                
                $lucro_liquido += $operacao->res_liq;
                $total_trades++;
                $volume_total += $operacao->qty_compra;
                
            }
        }

        $pct_acerto = ($total_trades > 0)? ($qtd_acertos / $total_trades) * 100: 0;
        $media_liq_trade = ($total_trades > 0)? $lucro_liquido / $total_trades: 0;
        $fator_lucro = ($perda_bruta != 0)? number_format($lucro_bruto / ($perda_bruta * -1), 2, ",", "."): "0.00";
        $pieCV = array();
        array_push($pieCV, $qtd_compra);
        array_push($pieCV, $qtd_venda);

        $pieGP = array();
        array_push($pieGP, $qtd_acertos);
        array_push($pieGP, $qtd_perdas);

        $dados['lucro_liquido'] =       number_format($lucro_liquido, 2, ",", ".");
        $dados['lucro_bruto'] =         number_format($lucro_bruto, 2, ",", ".");
        $dados['fator_lucro'] =         number_format($fator_lucro, 2, ",", ".");
        $dados['pct_acerto'] =          number_format($pct_acerto, 2, ",", ".");
        $dados['total_trades'] =        $total_trades;
        $dados['media_liq_trade'] =     number_format($media_liq_trade, 2, ",", ".");
        $dados['volume_total'] =        number_format($volume_total, 2, ",", ".");
        $dados['qtd_acerto'] =          $qtd_acertos;
        $dados['qtd_perda'] =           $qtd_perdas;
        $dados['qtd_compra'] =          $qtd_compra;
        $dados['qtd_venda'] =           $qtd_venda;
        $dados['pieCV'] =               $pieCV;
        $dados['pieGP'] =               $pieGP;
        $dados['lucro_liquido_trade'] = $lucro_liquido_trade;
        $dados['pontos_por_trade'] =    $pontos_por_trade;
        $dados['trades'] =              $trades;

        
        $melhor_trade = array();
        $pior_trade = array();
        foreach($trades_realizados as $tr)
        {
            $melhor = 0;
            $pior = 0;
            if($tr['lucro'] > $melhor)
            {
                $melhor_trade = $tr;
                $melhor =  (double)number_format($tr['lucro'], 2, ",", ".");
            }

            if($tr['lucro'] < $pior)
            {
                $pior_trade = $tr;
                $pior = (double)number_format($tr['lucro'], 2, ",", ".");
            }
        }

        $dados['melhor_trade']  = $melhor_trade;
        $dados['pior_trade']  = $pior_trade;

        echo json_encode($dados);

    }
    catch(Exception $erro)
    {
        echo "...";
    }


?>