<?php
session_start();
require_once '../conection/conexao.php';
require_once '../models/produtoModel.php';
require_once '../models/enderecoModel.php';
require_once '../models/clienteModel.php';
require_once '../models/itemModel.php';
require_once '../models/pedidoModel.php';


$_SESSION['items'] = [];
$_SESSION['totalDeItens'] = 0;

    
$mensagemDeErro = "";
$pdo = Conexao::conecta();
$endereco = $_POST['enderecoEscolha'];
$cliente = $_POST['cliente'];
$produtos = json_decode($_POST['items'], true);

echo "cliente: $cliente endereco: $endereco produtos: ";
var_dump($produtos);
echo"<hr>";
var_dump($_POST);

try{
    $pdo->beginTransaction();
    $pedido = new PedidoModel($cliente, $endereco, null, null); 
    $idPedido = $pedido->inserePedido();   

    foreach($produtos as $produto){
        $produtoCardapio = ProdutoModel::verProdutoPorId($produto);
        $item = new ItemModel($idPedido, $produtoCardapio->getId(),1,$produtoCardapio->getPreco());
        $item->inserirItem();
    }
    $pdo->commit();
}catch (PDOException $e){
    $pdo->rollBack();
    $mensagemDeErro = "aconteceu um erro $e";
}catch (RuntimeException $e){
    $pdo->rollBack();
    $mensagemDeErro = "aconteceu um erro $e";
}catch (Exception $e){
    $pdo->rollBack();
    $mensagemDeErro = "aconteceu um erro $e";
}

?>