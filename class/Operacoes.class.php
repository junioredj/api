<?php
 
    require_once "class/Conexao.class.php";
    class Operacoes
    {
        private $id;
        private $conta;
        private $titular;
        private $data;
        
        private $ativo;
        private $abertura;
        private $fechamento;
        private $tempoOperacao;
        private $qtdCompra;
        private $qtdVenda;
        private $lado;
        private $precoCompra;
        private $precoVenda;
        private $precoMercado;
        private $resultado;
        private $resultadoPercentual;
        private $resultadoOperacao;
        private $resultadoOperacaoPercentual;
        private $total;
        private $tet;
        private $tag;
        private $email;
        private $created;
        

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }
        
/**
         * Get the value of conta
         */
        public function getConta()
        {
                return $this->conta;
        }

        /**
         * Set the value of conta
         */
        public function setConta($conta): self
        {
                $this->conta = $conta;

                return $this;
        }

        /**
         * Get the value of titular
         */
        public function getTitular()
        {
                return $this->titular;
        }

        /**
         * Set the value of titular
         */
        public function setTitular($titular): self
        {
                $this->titular = $titular;

                return $this;
        }

        /**
         * Get the value of data
         */
        public function getData()
        {
                return $this->data;
        }

        /**
         * Set the value of data
         */
        public function setData($data): self
        {
                $this->data = $data;

                return $this;
        }

        /**
         * Get the value of ativo
         */
        public function getAtivo()
        {
                return $this->ativo;
        }

        /**
         * Set the value of ativo
         */
        public function setAtivo($ativo): self
        {
                $this->ativo = $ativo;

                return $this;
        }

        /**
         * Get the value of abertura
         */
        public function getAbertura()
        {
                return $this->abertura;
        }

        /**
         * Set the value of abertura
         */
        public function setAbertura($abertura): self
        {
                $this->abertura = $abertura;

                return $this;
        }

        /**
         * Get the value of fechamento
         */
        public function getFechamento()
        {
                return $this->fechamento;
        }

        /**
         * Set the value of fechamento
         */
        public function setFechamento($fechamento): self
        {
                $this->fechamento = $fechamento;

                return $this;
        }

        /**
         * Get the value of tempoOperacao
         */ 
        public function getTempoOperacao()
        {
                return $this->tempoOperacao;
        }

        /**
         * Set the value of tempoOperacao
         *
         * @return  self
         */ 
        public function setTempoOperacao($tempoOperacao)
        {
                $this->tempoOperacao = $tempoOperacao;

                return $this;
        }

        /**
         * Get the value of qtdCompra
         */
        public function getQtdCompra()
        {
                return $this->qtdCompra;
        }

        /**
         * Set the value of qtdCompra
         */
        public function setQtdCompra($qtdCompra): self
        {
                $this->qtdCompra = $qtdCompra;

                return $this;
        }

        /**
         * Get the value of qtdVenda
         */
        public function getQtdVenda()
        {
                return $this->qtdVenda;
        }

        /**
         * Set the value of qtdVenda
         */
        public function setQtdVenda($qtdVenda): self
        {
                $this->qtdVenda = $qtdVenda;

                return $this;
        }
        
        /**
         * Get the value of lado
         */
        public function getLado()
        {
                return $this->lado;
        }

        /**
         * Set the value of lado
         */
        public function setLado($lado): self
        {
                $this->lado = $lado;

                return $this;
        }

        /**
         * Get the value of precoCompra
         */
        public function getPrecoCompra()
        {
                return $this->precoCompra;
        }

        /**
         * Set the value of precoCompra
         */
        public function setPrecoCompra($precoCompra): self
        {
                $this->precoCompra = $precoCompra;

                return $this;
        }

        /**
         * Get the value of precoVenda
         */
        public function getPrecoVenda()
        {
                return $this->precoVenda;
        }

        /**
         * Set the value of precoVenda
         */
        public function setPrecoVenda($precoVenda): self
        {
                $this->precoVenda = $precoVenda;

                return $this;
        }

        /**
         * Get the value of precoMercado
         */
        public function getPrecoMercado()
        {
                return $this->precoMercado;
        }

        /**
         * Set the value of precoMercado
         */
        public function setPrecoMercado($precoMercado): self
        {
                $this->precoMercado = $precoMercado;

                return $this;
        }

        /**
         * Get the value of resultado
         */
        public function getResultado()
        {
                return $this->resultado;
        }

        /**
         * Set the value of resultado
         */
        public function setResultado($resultado): self
        {
                $this->resultado = $resultado;

                return $this;
        }

        /**
         * Get the value of resultadoPercentual
         */
        public function getResultadoPercentual()
        {
                return $this->resultadoPercentual;
        }

        /**
         * Set the value of resultadoPercentual
         */
        public function setResultadoPercentual($resultadoPercentual): self
        {
                $this->resultadoPercentual = $resultadoPercentual;

                return $this;
        }

        /**
         * Get the value of resultadoOperacao
         */
        public function getResultadoOperacao()
        {
                return $this->resultadoOperacao;
        }

        /**
         * Set the value of resultadoOperacao
         */
        public function setResultadoOperacao($resultadoOperacao): self
        {
                $this->resultadoOperacao = $resultadoOperacao;

                return $this;
        }

        /**
         * Get the value of resultadoOperacaoPercentual
         */
        public function getResultadoOperacaoPercentual()
        {
                return $this->resultadoOperacaoPercentual;
        }

        /**
         * Set the value of resultadoOperacaoPercentual
         */
        public function setResultadoOperacaoPercentual($resultadoOperacaoPercentual): self
        {
                $this->resultadoOperacaoPercentual = $resultadoOperacaoPercentual;

                return $this;
        }

        /**
         * Get the value of total
         */
        public function getTotal()
        {
                return $this->total;
        }

        /**
         * Set the value of total
         */
        public function setTotal($total): self
        {
                $this->total = $total;

                return $this;
        }

        /**
         * Get the value of tet
         */
        public function getTet()
        {
                return $this->tet;
        }

        /**
         * Set the value of tet
         */
        public function setTet($tet): self
        {
                $this->tet = $tet;

                return $this;
        }

        /**
         * Get the value of email
         */
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         */
        public function setEmail($email): self
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of created
         */
        public function getCreated()
        {
                return $this->created;
        }

        /**
         * Set the value of created
         */
        public function setCreated($created): self
        {
                $this->created = $created;

                return $this;
        }

        /**
         * Get the value of tag
         */
        public function getTag()
        {
                return $this->tag;
        }

        /**
         * Set the value of tag
         */
        public function setTag($tag): self
        {
                $this->tag = $tag;

                return $this;
        }

        public static function insertOperacaoes($conta, $titular, $data, $ativo, $abertura, $fechamento, $tempo_operacao, $qtd_compra, $qtd_venda, $lado, $preco_compra, $preco_venda, $preco_mercado, $resultado, $resultado_percentual, $resultado_operacao, $resultado_operacao_percentual, $total, $tet, $tag, $email)
        {
                try
                {
                        $con = Conexao::conectar();

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao conectar com banco de dados ".$erro->getMessage());
                }

                try
                {
                        $sql = "insert into tb_operacoes values(null, :conta, :titular, :data, :ativo, :abertura, :fechamento, :tempo_operacao, :qtd_compra, :qtd_venda, :lado, :preco_compra, :preco_venda, :preco_mercado, :resultado, :resultado_percentual, :resultado_operacao, :resultado_operacao_percentual, :total, :tet, :tag, now(), :email, :daytrade);";
                        $pst = $con->prepare($sql);

                        $pst->bindParam(":conta", $conta);
                        $pst->bindParam(":titular", $titular);
                        $pst->bindParam(":data", $data);
                        $pst->bindParam(":ativo", $ativo);
                        $pst->bindParam(":abertura", $abertura);
                        $pst->bindParam(":fechamento", $fechamento);
                        $pst->bindParam(":tempo_operacao", $tempo_operacao);
                        $pst->bindParam(":qtd_compra", $qtd_compra);
                        $pst->bindParam(":qtd_venda", $qtd_venda);
                        $pst->bindParam(":lado", $lado);
                        $pst->bindParam(":preco_compra", $preco_compra);
                        $pst->bindParam(":preco_venda", $preco_venda);
                        $pst->bindParam(":preco_mercado", $preco_mercado);
                        $pst->bindParam(":resultado", $resultado);
                        $pst->bindParam(":resultado_percentual", $resultado_percentual);
                        $pst->bindParam(":resultado_operacao", $resultado_operacao);
                        $pst->bindParam(":resultado_operacao_percentual",$resultado_operacao_percentual);
                        $pst->bindParam(":total",$total);
                        $pst->bindParam(":tet",$tet);
                        $pst->bindParam(":tag", $tag);
                        $pst->bindParam(":email",$email);
                        $inicio = new DateTime($abertura);
                        $fim = new DateTime($fechamento);

                        $daytrade = false;
                        if($inicio->diff($fim)->days == 0)
                                $daytrade = true;
                        
                        $pst->bindParam(":daytrade",$daytrade);



                        
                        $pst->execute();
                        
                        if($pst->rowCount() > 0)
                                return true;
                        else
                                return false;



                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao inserir operações ".$erro->getMessage());
                }
        }


        public static function getOperacoesByCliente($email)
        {
                try
                {
                        $con = Conexao::conectar();

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao conectar com banco de dados ".$erro->getMessage());
                }

                try
                {
                        $sql = "select id, conta, titular, data_arquivo, ativo, abertura, fechamento, tempo_operacao, qtd_compra, qtd_venda, lado, preco_compra, preco_venda, preco_mercado, resultado, resultado_percentual, resultado_operacao, resultado_operacao_percentual, total, tet, tag, email, created from tb_operacoes where email = :email order by fechamento asc;";
                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->execute();
                        
                        $dados = $pst->fetchAll(PDO::FETCH_OBJ);

                        //return json_encode(array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5));
                        $qtd_vendido = 0;
                        $qtd_comprado= 0;

                        $json = array();
                        foreach($dados as $dado)
                        {

                                if(strtolower($dado->lado) == "v")
                                        $qtd_vendido++;
                                else
                                        $qtd_comprado;
                                $itens = array(
                                        'dt_abertura' => $dado->abertura,
                                        'dt_fechamento' => $dado->fechamento,
                                        'codigo' => $dado->ativo,
                                        'lado' => $dado->lado,
                                        'qty_compra' => $dado->qtd_compra,
                                        'qty_venda' => $dado->qtd_venda,
                                        'preco_compra' => $dado->preco_compra,
                                        'preco_venda' => $dado->preco_venda,
                                        'res_bruto' => $dado->resultado,
                                        'corretagem' => "R$0",
                                        'taxas' => "R$0",
                                        'res_liq' => $dado->resultado,
                                        'tags' => $dado->tag,
                                        'pct' => "%",
                                        'opcoes' => " "
                                );

                                array_push($json, $itens);
                                
                        }

                        
                        $retorno['comprado'] = $qtd_comprado;
                        $retorno['vendido'] = $qtd_vendido;
                        

                        return json_encode($json);
    

                        





                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao consultar operações ".$erro->getMessage());
                }
        }

        public static function getOperacoesByClienteYear($email)
        {
                try
                {
                        $con = Conexao::conectar();

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao conectar com banco de dados ".$erro->getMessage());
                }

                try
                {
                        $sql = "SELECT resultado,fechamento from tb_operacoes where year(fechamento) = YEAR(now()) and email = :email";
                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->execute();
                        
                        
                        $dados = $pst->fetchAll(PDO::FETCH_OBJ);

                        //return json_encode(array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5));

                        $resultado_ano = 0;
                        $resultado_dia = 0;
                        $resultado_mes = 0;

                        $mes = date('m');
                        $dia = date('d');
                        
                        $json = array();

                        $json_mes = array();
                        $json_dia = array();
                        $prejuizo_bruto = 0;
                        $lucro_bruto = 0;
                        foreach($dados as $dado)
                        {

                                $resultado_ano += ($dado->resultado);
                                if($dado->resultado > 0)
                                        $lucro_bruto += $dado->resultado;
                                else
                                        $prejuizo_bruto += ($dado->resultado * -1);
                                if(date('m', strtotime($dado->fechamento)) == $mes)
                                {
                                        
                                        $resultado_mes += $dado->resultado;
                                        array_push($json_mes, array(
                                                'vm' => $dado->resultado,
                                        ));
                                }
                                
                                if(date('d', strtotime($dado->fechamento)) == $dia)
                                {
                                        $resultado_dia += $dado->resultado;
                                        array_push($json_dia, array(
                                                'vd' => $dado->resultado,
                                        ));
                                }

                                $itens = array(
                                        'va' => $dado->resultado,
                                );

                                array_push($json, $itens);
                                
                        }

                        $profit_factor = 0;
                        if($prejuizo_bruto != 0 && $lucro_bruto != 0)
                                $profit_factor = $lucro_bruto / $prejuizo_bruto;

                        $json_main = [];
                        $json_main['date'] = date("d/m/Y");
                        $json_main['profit'] = number_format($lucro_bruto - $prejuizo_bruto, 2);
                        $json_main['profit_factor'] = number_format($profit_factor, 2);
                        $json_main['result_day'] = $resultado_dia;
                        $json_main['result_mon'] = $resultado_mes;
                        $json_main['result_year'] = $resultado_ano;

                        $json_main['year'] = $json;
                        $json_main['mon'] = $json_mes;
                        $json_main['day'] = $json_dia;
                        
                        return json_encode($json_main);

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao consultar operações ".$erro->getMessage());
                }
        }

        public static function geEvolucaoPatrimonial($email)
        {
                try
                {
                        $con = Conexao::conectar();

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao conectar com banco de dados ".$erro->getMessage());
                }

                try
                {
                        $sql = "select resultado as y, fechamento as x from tb_operacoes where email = :email;
                        ";
                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->execute();
                        
                        $dados = $pst->fetchAll(PDO::FETCH_OBJ);

                        $json = array("data" => array());
                        foreach($dados as $dado)
                        {


                                $itens = array(
                                        'x' => date("m-d-Y", strtotime($dado->x)),
                                        'y' => $dado->y,
                                        
                                );

                                array_push($json["data"], $itens);
                                
                        }

                        return json_encode(array($json));

                        





                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao consultar operações ".$erro->getMessage());
                }
        }

        public static function getOperacoesByClienteSimulator($email, $tag, $lado, $tipo, $codigo , $data)
        {
                try
                {
                        $con = Conexao::conectar();

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao conectar com banco de dados ".$erro->getMessage());
                }

                try
                {
                        $tags = $tag ."%"  ;
                        $complemento = ($tipo == "nenhum")? "": " and daytrade = ". $tipo;
                        $complemento.= ($data == 0)? "": " and fechamento >= '".$data."'";
                        
                        $sql = "select id, conta, titular, data_arquivo, ativo, abertura, fechamento, tempo_operacao, qtd_compra, qtd_venda, lado, preco_compra, preco_venda, preco_mercado, resultado, resultado_percentual, resultado_operacao, resultado_operacao_percentual, total, tet, tag, email, created from tb_operacoes where email = :email and tag like :tag and lado like :lado ".$complemento." and ativo like :codigo order by fechamento asc;";
                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->bindValue(":tag", $tags."%");
                        $pst->bindValue(":lado", $lado."%");
                        $pst->bindValue(":codigo", $codigo."%");
                        $pst->execute();

                        
                        $dados = $pst->fetchAll(PDO::FETCH_OBJ);

                        //return json_encode(array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5));
                        $qtd_vendido = 0;
                        $qtd_comprado= 0;

                        $json = array();
                        foreach($dados as $dado)
                        {

                                if(strtolower($dado->lado) == "v")
                                        $qtd_vendido++;
                                else
                                        $qtd_comprado;
                                $itens = array(
                                        'dt_abertura' => $dado->abertura,
                                        'dt_fechamento' => $dado->fechamento,
                                        'codigo' => $dado->ativo,
                                        'lado' => $dado->lado,
                                        'qty_compra' => $dado->qtd_compra,
                                        'qty_venda' => $dado->qtd_venda,
                                        'preco_compra' => $dado->preco_compra,
                                        'preco_venda' => $dado->preco_venda,
                                        'res_bruto' => $dado->resultado,
                                        'corretagem' => "R$0",
                                        'taxas' => "R$0",
                                        'res_liq' => $dado->resultado,
                                        'tags' => $dado->tag,
                                        'pct' => "%",
                                        'opcoes' => " "
                                );

                                array_push($json, $itens);
                                
                        }

                        
                        $retorno['comprado'] = $qtd_comprado;
                        $retorno['vendido'] = $qtd_vendido;
                        

                        return json_encode($json);
    

                        





                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao consultar operações ".$erro->getMessage());
                }
        }

        

        
    }
?>