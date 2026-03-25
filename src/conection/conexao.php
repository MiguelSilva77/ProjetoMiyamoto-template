<?php
/*
criado por Miguel Silva
classe responsável por estabelecer a conexão com o banco de dados
*/
    class Conexao{

        public static function conecta(){
            $pdo = new PDO('mysql:host=db;dbname=app_db', 'root','root');
            return $pdo;
        }

    }



?>