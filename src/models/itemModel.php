<?php

class ItemModel{
private $id_item;
private $pedido;
private $produto;
private $quantidade;
private $precoUnitario;

public function __construct($pedido = null, $produto = null, $quantidade = null, $precoUnitario = null, $id_item = null){
    $this->pedido = $pedido;
    $this->produto = $produto;
    $this->quantidade = $quantidade;
    $this->precoUnitario = $precoUnitario;
    $this->id_item = $id_item;
}

public function getId(){
    return $this->id_item;
}


public function getPedido(){
    return $this->pedido;
}


public function getProduto(){
    return $this->produto;
}

public function getQuantidade(){
    return $this->quantidade;
}

public function getPrecoUnitario(){
    return $this->precoUnitario;
}

public function setId($id){
    $this->id_item = $id;
}

public function setPedido($pedido){
    $this->pedido = $pedido;
}

public function setProduto($produto){
    $this->produto = $produto;
}

public function setQuantidade($quantidade){
    $this->quantidade = $quantidade;
}

public function setPrecoUnitario($precoUnitario){
    $this->precoUnitario = $precoUnitario;
}

public function inserirItem(){
    $pdo = Conexao::conecta();
    $sql = "INSERT INTO ITEM_PEDIDO (idPedido, idProduto, quantidade, preco_unitario)
        VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $this->pedido,
        $this->produto,
        $this->quantidade,
        $this->precoUnitario,
    ]);
}

public static function verPedidoPorId($id){
    $pdo = Conexao::conecta();
    $items = [];
    $sql = "SELECT * FROM ITEM_PEDIDO WHERE idPedido = $id";
    $stmt = $pdo->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $item = new ItemModel();

        $item->setId($row['idItem']);
        $item->setPedido($row['idPedido']);
        $item->setProduto($row['idProduto']);
        $item->setQuantidade($row['quantidade']);
        $item->setPrecoUnitario($row['preco_unitario']);

        $items[] = $item;
    }
    return $items;
}

}

