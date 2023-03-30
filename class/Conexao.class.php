<?php
    class Conexao
    {
        public static function conectar()
        {

            /*$host = "localhost";
            $user = "root";
            $senha = "";
            $banco = "trademetria";*/


            $host = "db-mysql-nyc1-07321-do-user-6571748-0.b.db.ondigitalocean.com:25060";
            $user = "dash_user";
            $senha = "AVNS_GcmIiXCgLclA1goFjov";
            $banco = "trademetria";
            


            try
            {
                $conexao = new PDO("mysql:dbname=$banco;host=$host", $user,$senha); 
                return $conexao;
            }
            catch(PDOException $erro_banco)
            {
                echo "Erro com banco de dados ".$erro_banco->getMessage();
            }
            catch(Exception $erro)
            {
                echo "Erro genérico ".$erro->getMessage();
            }

            return $conexao;
        }
    }
?>