<?php
/*
criado por Miguel Silva, class ClienteEnderecoModel, responsável por fazer as operações no bando de 
dados referente a tabela ClienteEnderecoModel

*/
require_once '../conection/conexao.php';
require_once '../models/clienteModel.php';
require_once '../models/enderecoModel.php';

class ClienteEnderecoModel{
    private $id_cliente;
    private $id_endereco;

    public function __construct($id_cliente, $id_endereco){
        $this->id_cliente = $id_cliente;
        $this->id_endereco = $id_endereco;
        
    }

    public function inserirClienteEndereco(){
        $pdo = Conexao::conecta();
        //mudar essa linha depois, apenas carater de teste de conexão
        $sql = "INSERT INTO CLIENTE_ENDERECO_TESTE (id_cliente, id_endereco) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->id_cliente, 
                        $this->id_endereco]);

        return $pdo->lastInsertId();
    }

}


?>