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
$compraRealizada = 0;

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
    $compraRealizada = 1;
}catch (PDOException $e){
    $pdo->rollBack();
    $mensagemDeErro = "aconteceu um erro $e";
    $compraRealizada = 2;
}catch (RuntimeException $e){
    $pdo->rollBack();
    $mensagemDeErro = "aconteceu um erro $e";
    $compraRealizada = 2;
}catch (Exception $e){
    $pdo->rollBack();
    $mensagemDeErro = "aconteceu um erro $e";
    $compraRealizada = 2;
}

    if($compraRealizada == 1){
        echo'
        <dialog>
            <h1>Pedido Realizado Com Sucesso</h1>
            <a href="../index.php">
                <button>Sair</button>
            </a>
        </dialog>
    
        ';
    }else if ($compraRealizada == 2){
        echo'<dialog>
            <h1>Algo deu Errado :( </h1>
            <h3>'.$mensagemDeErro.'</h3>
            <a href="../config.php">
                <button>Sair</button>
            </a>
                <button onClick="window.history.back()">Voltar</button>
        </dialog>';
    }



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adiciona Pedido</title>
</head>
<body>
    <script src="../javascript/scriptModal.js"></script>
</body>
</html>