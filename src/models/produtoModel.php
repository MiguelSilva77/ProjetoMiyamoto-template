<?php
require_once __DIR__.'/../conection/conexao.php';

class ProdutoModel{
    private $id_produto;
    private $nome;
    private $preco;
    private $descricao;


    public function __construct($id_produto = null, $nome = null, $preco = null, $descricao = null){
        $this->id_produto = $id_produto;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->descricao = $descricao;
    }

    public function getId(){
        return $this->id_produto;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setId($id){
        $this->id_produto = $id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setPreco($preco){
        $this->preco = $preco;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }




}



?>