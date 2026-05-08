<?php
session_start();
require_once __DIR__.'/../conection/conexao.php';
require_once __DIR__.'/../models/produtoModel.php';

if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: index.php');
    exit;
}

$idProduto = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? null;
$produto = ProdutoModel::verProdutoPorId($idProduto);
$pdo = Conexao::conecta();
$atualizacaoRealizada = 0;
$mensagemDeErro = "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/modal.css">
    <title>Edita Produto</title>
</head>
<body>
    <?php
if($nome == null){
    echo'<form action="" method="post" onsubmit="return confirm(\'Atualizar Informações?\')">

    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" maxlength="100" value="'.$produto->getNome().'">

    <label for="preco">Preço</label>
    <input type="number" name="preco" id="preco" step="0.01" min="0.01" max="999.99" value="'.$produto->getPreco().'">

    <label for="descricao">Descrição</label>
    <input type="text" name="descricao" id="descricao" maxlength="200" value="'.$produto->getDescricao().'">

    <input type="hidden" name="id" id="id" value="'.$produto->getId().'"> 

    <button type="submit">Atualizar</button>

    </form>';
}else{
    $preco = $_POST['preco'] ?? null;
    $descricao = $_POST['descricao'] ?? null;

    $produtoAtualizado = new ProdutoModel($idProduto, $nome, $preco, $descricao);

    try{
    $pdo->beginTransaction();
    $produtoAtualizado->editaProduto($produtoAtualizado);
    $atualizacaoRealizada = 1;
    $pdo->rollBack();
    }catch (PDOException $e){
        $mensagemDeErro = 'Erro: '.$e->getMessage();
        $atualizacaoRealizada = 2;
        $pdo->rollBack();
    }catch(RuntimeException $e){
        $mensagemDeErro = 'Erro: '.$e->getMessage();
        $atualizacaoRealizada = 2;
        $pdo->rollBack();
    }catch(Exception $e){
        $mensagemDeErro = 'Erro: '.$e->getMessage();
        $atualizacaoRealizada = 2;
        $pdo->rollBack();
    }

    if($atualizacaoRealizada == 1){
         echo'<dialog>
            <h1>Dados Atualizados com sucesso</h1>
            <a href="../config.php">
                <button>Sair</button>
            </a>
        </dialog>';
    }else if($atualizacaoRealizada == 2){
         echo'<dialog>
            <h1>'.$mensagemDeErro.'</h1>
            <a href="../config.php">
                <button>Sair</button>
            </a>
            <button onClick="window.history.back()">Voltar</button>
        </dialog>';
    }
}
?>
<script src="../javascript/scriptModal.js"></script>
</body>
</html>






