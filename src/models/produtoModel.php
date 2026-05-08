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

    public function adicionaProduto(){
        $pdo = Conexao::conecta();
        $sql = "INSERT INTO PRODUTO (id_produto, nome, preco, descricao)
                VALUES (null, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $this->nome,
            $this->preco,
            $this->descricao
        ]);
        $this->id_produto = $pdo->lastInsertId();
        return $this;
    }

    public static function verTodosOsProdutos(){
        $pdo = Conexao::conecta();
        $produtos = [];
        $sql = "SELECT * FROM PRODUTO";
        $stmt = $pdo->query($sql);
        while($rows = $stmt->fetch(PDO::FETCH_ASSOC)){
            $produto = new ProdutoModel();

            $produto->setId($rows['id_produto']);
            $produto->setNome($rows['nome']);
            $produto->setPreco($rows['preco']);
            $produto->setDescricao($rows['descricao']);

            $produtos[] = $produto;
        }
        return $produtos;
    }

    public static function deletaProduto($id){
        $pdo = Conexao::conecta();
        $sql = "DELETE FROM PRODUTO WHERE id_produto = '$id' ";
        $stmt = $pdo->query($sql);
    }

    public static function verProdutoPorId($id){
        $pdo = Conexao::conecta();
        $produtos = null;
        $sql = "SELECT * FROM PRODUTO WHERE id_produto = $id";
        $stmt = $pdo->query($sql);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $produto = new ProdutoModel();

            $produto->setId($row['id_produto']);
            $produto->setNome($row['nome']);
            $produto->setPreco($row['preco']);
            $produto->setDescricao($row['descricao']);

            $produtos = $produto;
        }
        return $produtos;
    }

    public function editaProduto($produto){
        $pdo = Conexao::conecta();
        $sql = "UPDATE PRODUTO set
                nome = :nome,
                descricao = :descricao,
                preco = :preco
                WHERE id_produto = :id
                ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nome',$produto->getNome());
        $stmt->bindValue(':descricao',$produto->getDescricao());
        $stmt->bindValue(':preco',$produto->getPreco());
        $stmt->bindValue(':id',$produto->getId());

        $stmt->execute();
        return $produto->getId();
    }


}



?>