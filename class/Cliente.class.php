<?php

    class Cliente
    {
        private $email;
        private $senha;
        private $nome;
        private $created;
        private $last_update;

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
         * Get the value of senha
         */
        public function getSenha()
        {
                return $this->senha;
        }

        /**
         * Set the value of senha
         */
        public function setSenha($senha): self
        {
                $this->senha = $senha;

                return $this;
        }

        /**
         * Get the value of nome
         */
        public function getNome()
        {
                return $this->nome;
        }

        /**
         * Set the value of nome
         */
        public function setNome($nome): self
        {
                $this->nome = $nome;

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
         * Get the value of last_update
         */
        public function getLastUpdate()
        {
                return $this->last_update;
        }

        /**
         * Set the value of last_update
         */
        public function setLastUpdate($last_update): self
        {
                $this->last_update = $last_update;

                return $this;
        }

        public static function login($email, $senha)
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
                        $sql = "select email,nome from tb_cliente where email = :email and senha = md5(:senha);";
                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->bindParam(":senha", $senha);
                        $pst->execute();

                        // return $pst->debugDumpParams();

                        if($pst->rowCount() > 0)
                        {
                                
                                $dados = $pst->fetch(PDO::FETCH_OBJ);
                                $nome = explode(" ", $dados->nome);
                                $sobrenome = "";
                                if(count($nome) > 1)
                                        $sobrenome = $nome[1];

                                return json_encode(array("login" => "true", "email" => $dados->email, "nome" => $nome[0], "sobrenome" => $sobrenome));
                        }
                        else
                        {
                                return json_encode(array("login" => "false"));
                        }
                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao validar dados de login do usuário".$erro);
                }
        }

        public static function emailExistente($email)
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
                        $sql = "select email from tb_cliente where email = :email ;";
                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->execute();

                        if($pst->rowCount() > 0)
                        {
                                return true;
                        }
                        else
                        {
                                return false;
                        }
                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao validar dados de login do usuário".$erro);
                }
        }

        public static function insertClient($email, $senha, $nome)
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
                        if(!Cliente::emailExistente($email))
                        {
                                $sql = "insert into tb_cliente values(:email, md5(:senha), :nome, now(), now());";
                                $pst = $con->prepare($sql);
                                $pst->bindParam(":email", $email);
                                $pst->bindParam(":senha", $senha);
                                $pst->bindParam(":nome", $nome);
                                $pst->execute();

                                if($pst->rowCount() > 0)
                                {
                                        
                                        return json_encode(array("register" => "true", "email" => $email, "duplicate" => "false"));
                                }
                                else
                                {
                                        return json_encode(array("register" => "false", "duplicate" => "false"));
                                }
                        }
                        else
                        {
                                return json_encode(array("register" => "false", "duplicate" => "true"));
                        }
                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao cadastrar usuário".$erro);
                }
        }

        public static function updateCliente($email, $senha, $nome)
        {
                try
                {
                        $con = Conexao::conectar();

                }
                catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao conectar com banco de dados ".$erro->getMessage());
                }

                if(true)
                {
                        if($senha == "" || $senha == null)
                                $sql = "update tb_cliente set nome = :nome, last_update =  now() where email = :email;";
                        else
                                $sql = "update tb_cliente set senha = md5(:senha), nome = :nome, last_update =  now() where email = :email;";

                        $pst = $con->prepare($sql);
                        $pst->bindParam(":email", $email);
                        $pst->bindParam(":nome", $nome);

                        if($senha != "" && $senha != null)
                                $pst->bindParam(":senha", $senha);
                                
                        $pst->execute();

                        if($pst->rowCount() > 0)
                        {
                                $nome_array = explode(" ", $nome);
                                $sobrenome = "";
                                if(count($nome_array) > 1)
                                        $sobrenome = $nome_array[1];

                                
                                return json_encode(array("update" => "true", "email" => $email, "nome_completo" => $nome, "nome" => $nome_array[0], "sobrenome" => $sobrenome));
                        }
                        else
                        {
                                return json_encode(array("update" => "false"));
                        }
                }
                /*catch(PDOException $erro)
                {
                        throw new PDOException("Erro ao cadastrar usuário".$erro);
                }*/
        }
    }

?>