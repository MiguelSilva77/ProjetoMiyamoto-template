<?php

class PedidoModel{
    private $idPedido;
    private $cliente;
    private $endereco;
    private $dataPedido;

    public function __construct($cliente = null, $endereco = null, $idPedido = null, $data = null){
        $this->idPedido = $idPedido;
        $this->cliente = $cliente;
        $this->endereco = $endereco;
        $this->dataPedido = $data;

    }

    public function getId(){
        return $this->idPedido;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function getDataPedido(){
        return $this->dataPedido;
    }

    public function setId($id){
        $this->idPedido = $id;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

     public function setDataPedido($data){
        $this->dataPedido = $data;
    }


    public function inserePedido(){
        $pdo = Conexao::conecta();
        $sql = "INSERT INTO PEDIDOTESTE (idCliente, idEndereco)
        VALUES (?, ?)"; 
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $this->cliente,
            $this->endereco
        ]);
        return $this->idPedido = $pdo->lastInsertId();
    }
}


