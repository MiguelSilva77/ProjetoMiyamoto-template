<?php

class ItemModel{
private $id_item;
private $pedido;
private $produto;
private $quantidade;
private $precoUnitario;

public function __construct($pedido, $produto, $quantidade, $precoUnitario, $id_item = null){
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

}

