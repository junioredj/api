<?php
    require_once "autoload.php";

    
    header('Content-type: application/json; charset=utf-8');   
    header("Access-Control-Allow-Origin: *");
    //header("Access-Control-Allow-Methods: PUT, GET, POST");

    

    
    
    //$arquivo = $_FILES['file'];

    //var_dump(json_decode(file_get_contents('php://input')));

    $arquivo = $_FILES['file'];

    

    
    $conta = null;
    $titular = null;
    $data_registro = null;


    var_dump($_FILES);
    echo "====";
    var_dump($_REQUEST);
    
    
    if(isset($_REQUEST['email']) && !empty($_REQUEST['email']))
    {

    
        try
        {
            if(true)//$arquivo['type'] == "application/vnd.ms-excel")
            {
                $dados_arquivo = fopen($arquivo['tmp_name'], "r");

                

                $format = numfmt_create('pt_BR', NumberFormatter::DECIMAL);
                $tag = $_REQUEST['tags'];

                while($linha = fgetcsv($dados_arquivo, 1000, ";"))
                {
                    
                    //***************************************************************************************************** */
                    // Obtem as informações de cabecalho 
                    //***************************************************************************************************** */

                    
                    if(isset($linha[0]) && $conta == null)
                    {
                        
                        if(strpos($linha[0], "Conta"))
                        {
                            $dados = explode(":", $linha[0]);
                            $conta = trim($dados[1]);
                        }
                    }

                    

                    if(isset($linha[0]) && $titular == null)
                    {
                        if(strpos($linha[0], "Titular"))
                        {
                            $dados = explode(":", $linha[0]);
                            $titular = trim($dados[1]);
                        }
                    }

                    if(isset($linha[0]) && $data_registro == null)
                    {
                        
                        
                        if(strpos($linha[0], "Data"))
                        {
                            
                            $dados = explode(":", $linha[0]);
                            $data_registro = trim($dados[1]);
                        }
                    }

                    //***************************************************************************************************** */
                    //Obtem as informações do conteudo do arquivo 
                    //***************************************************************************************************** */

                    //Verifica se existe algum valor nessa célula
                    if(isset($linha[15]))
                    {
                        //Verifica se não é linha de cabelcalho
                        if($linha[15] != "TET")
                        {
                            /*echo 'Ativo => '.                  ($linha[0]?? null)."<br>";
                            echo  'Abertura => '.              ($linha[1]?? null)."<br>";
                            echo  'Fechamento => '.            ($linha[2]?? null)."<br>";
                            echo  'Tempo Opera��o =>'.        ($linha[3]?? null)."<br>";
                            echo  'Qtd Compra => '.            ($linha[4]?? null)."<br>";
                            echo  'Qtd Venda => '.             ($linha[5]?? null)."<br>";
                            echo  'Lado => '.                  ($linha[6]?? null)."<br>";
                            echo 'Pre�o Compra => '.           ($linha[7]?? null)."<br>";
                            echo 'Pre�o Venda => '.            ($linha[8]?? null)."<br>";
                            echo 'Pre�o de Mercado => '.       ($linha[9]?? null)."<br>";
                            echo 'Resultado => '.              ($linha[10]?? null)."<br>";
                            echo 'Resultado(%) => '.           ($linha[11]?? null)."<br>";
                            echo 'Res. Opera��o => '.          ($linha[12]?? null)."<br>";
                            echo 'Res. Opera��o (%) => '.      ($linha[13]?? null)."<br>";
                            echo 'Total => '.                  ($linha[14]?? null)."<br>";
                            echo 'TET => '.                    ($linha[15]?? null)."<br>";
                            echo "<hr>";*/


                            try
                            {
                                $ativo = ($linha[0]?? null);
                                $abertura = date("Y-m-d h:i:s", strtotime(str_replace("/", "-", $linha[1]?? null)));
                                $fechamento = date("Y-m-d h:i:s", strtotime(str_replace("/", "-", $linha[2]?? null)));
                                $tempo_operacao = ($linha[3]?? null);
                                $qtd_compra = ($linha[4]?? null);
                                $qtd_venda = ($linha[5]?? null);
                                $lado = ($linha[6]?? null);
                                $preco_compra = numfmt_parse($format, $linha[7]?? null);
                                $preco_venda =  numfmt_parse($format, $linha[8]?? null);
                                $preco_mercado =  numfmt_parse($format, $linha[9]?? null);
                                $resultado =  numfmt_parse($format, $linha[10]?? null);
                                $resultado_percentual = numfmt_parse($format, $linha[11]?? null);
                                $resultado_operacao = numfmt_parse($format, $linha[12]?? null);
                                $resultado_operacao_percentual = numfmt_parse($format, $linha[13]?? null);
                                $total = numfmt_parse($format, $linha[14]?? null);
                                $tet = ($linha[15]?? null);
                                $email = trim($_REQUEST['email']);//"eve.holt@reqres.in";
                                $data_registro = date("Y-m-d h:i:s", strtotime(str_replace("/", "-", $data_registro)));



                                try
                                {
                                    Operacoes::insertOperacaoes($conta, $titular, $data_registro, $ativo, $abertura, $fechamento, $tempo_operacao, $qtd_compra, $qtd_venda, $lado, $preco_compra, $preco_venda, $preco_mercado, $resultado, $resultado_percentual, $resultado_operacao, $resultado_operacao_percentual, $total, $tet, $tag, $email);
                                }
                                catch(PDOException $erro)
                                {
                                    throw new PDOException("Erro ao inserir operações ".$erro);
                                }
                            }
                            catch(Exception $erro)
                            {
                                throw new Exception("Erro");
                            }

                        }
                    }
                }
            }
            else
            {
                echo "Arquivo inválido";
            }
        }
        catch(Exception $erro)
        {
            throw new Exception("Erro ao ler arquivo".$erro);
        }
    }

?>