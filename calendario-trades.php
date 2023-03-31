<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    require_once "autoload.php";


    try
    {
        $email = $_REQUEST['email'];
        
        $operacoes = Operacoes::getOperacoesByCliente($email);

        $operacoes = json_decode($operacoes);


        $dias = array();
        $meses = array();
        $ultimo_mes = "";
        $dia_salvo = 0;
        $mes_salvo = 0;
        $lucro = 0;
        $trades = 0;

        $dia_corrente = "";
        foreach($operacoes as $operacao)
        {

            if($operacao->qty_compra == $operacao->qty_venda)
            {
                $dia = date("d", strtotime($operacao->dt_fechamento));
                if($dia != $dia_salvo)
                {
                    $dia_salvo = $dia;

                    
                    if($trades > 0)
                    {
                        array_push($dias, array("dia" => $dia_corrente, "lucro" => $lucro));

                        $mes = date("m", strtotime($operacao->dt_fechamento));
                        if($mes != $mes_salvo)
                        {
                            $mes_salvo = $mes;
                            array_push($meses, date("Y-m", strtotime($operacao->dt_fechamento)));
                        }

                        $lucro = 0;
                        $trades = 0;
                    }

                    $dia_corrente = date("Y-m-d", strtotime($operacao->dt_fechamento));
                    
                }

                $lucro += $operacao->res_liq;
                $trades++;
            }

        }
        array_push($dias, array("dia" => $dia_corrente, "lucro" => $lucro));
        

        $dados = array();
        
        foreach($meses as $m)
        {
            $inicio_dia_sem_preeencher = 1;
            $ultimo_dia_mes = (int)date("t", strtotime($m));
            // echo date("t", strtotime($m))."<BR>";
            $controle = array();
            foreach($dias as $d)
            {
                $d = (object)$d;
                if(date("Y-m", strtotime($d->dia)) == $m)
                {
                    
                    // echo $d->dia." Lucro: ".$d->lucro." Dia: ".date("d", strtotime($d->dia))."<BR>";

                    $dia_interacao = date("d", strtotime($d->dia));


                    
                    if($inicio_dia_sem_preeencher < $dia_interacao)
                    {
                        for($i = $inicio_dia_sem_preeencher; $i < $dia_interacao; $i++)
                        {
                            array_push($controle, array("dia" => $i, "lucro" => 0));
                            $inicio_dia_sem_preeencher = $dia_interacao + 1;
                        }
                    }
                    else
                        $inicio_dia_sem_preeencher = $dia_interacao + 1;

                    for($i = 1; $i <= $ultimo_dia_mes; $i++)
                    {
                        if($dia_interacao == $i)
                        {
                            array_push($controle, array("dia" => $i, "lucro" => $d->lucro));
                            break;
                        }

                    }

                }
            }

            if($inicio_dia_sem_preeencher < $ultimo_dia_mes)
            {
                for($i = $inicio_dia_sem_preeencher; $i <= $ultimo_dia_mes; $i++)
                {
                    array_push($controle, array("dia" => $i, "lucro" => 0));
                    $inicio_dia_sem_preeencher = $ultimo_dia_mes + 1;
                }
            }
            else
                $inicio_dia_sem_preeencher = $ultimo_dia_mes + 1;
            
                // echo $ultimo_dia_mes;

            $dados[date("Y-M", strtotime($m))] = $controle;

        }
        // $dados['d'] = $controle;
        // $dados['dia'] = $dias;   
        // $dados['mes'] = $meses;
        echo json_encode($dados);
    }
    catch(Exception $erro)
    {
        throw new Exception("erro: ", $erro->getMessage());
    }


    

?>