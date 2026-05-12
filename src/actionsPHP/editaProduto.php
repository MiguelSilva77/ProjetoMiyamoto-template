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
$nome = $_POST['nomeProduto'] ?? null;
$produto = null;
if ($nome == null && $idProduto != null) {
    $produto = ProdutoModel::verProdutoPorId($idProduto);
}
$pdo = Conexao::conecta();
$atualizacaoRealizada = 0;
$mensagemDeErro = "";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/header2.css">
    <link rel="stylesheet" href="../styles/editaCliente.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/modal.css">
    <title>Edita Produto</title>
</head>
<body>
    <main>
    <?php
    require_once '../header.php';
if(!isset($_POST['btn_atualizar'])){
    echo'
    <div class="containerGrande">
        <div class="container">
            <form action="" method="post" onsubmit="return confirm(\'Atualizar Informações?\')">

            <label for="nome">Nome</label>
            <input type="text" name="nomeProduto" id="nome" maxlength="100" value="'.$produto->getNome().'">

            <label for="preco">Preço</label>
            <input type="number" name="preco" id="preco" step="0.01" min="0.01" max="999.99" value="'.$produto->getPreco().'">

            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" maxlength="200" value="'.$produto->getDescricao().'">

            <input type="hidden" name="id" id="id" value="'.$produto->getId().'"> 

            <input type="hidden" name="btn_atualizar" value="1"> 
            <button type="submit" class="btn-cadastrar">Atualizar</button>

            </form>
        </div>
    </div>';
}else{
   $id_do_form = $_POST['id'] ?? null;
    $nome_do_form = $_POST['nomeProduto'] ?? null;
    $preco_do_form = $_POST['preco'] ?? null;
    $desc_do_form = $_POST['descricao'] ?? null;

    // Criando o objeto com as variáveis que acabamos de capturar
    $produtoAtualizado = new ProdutoModel($id_do_form, $nome_do_form, $preco_do_form, $desc_do_form);

    try {
        $pdo->beginTransaction();
        $produtoAtualizado->editaProduto($produtoAtualizado); 
        $pdo->commit();
        $atualizacaoRealizada = 1;
    } catch (Exception $e) {
        if ($pdo->inTransaction()) $pdo->rollBack();
        $mensagemDeErro = 'Erro: ' . $e->getMessage();
        $atualizacaoRealizada = 2;
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
</main>
</body>
<?php require_once '../footer.php'; ?>
</html>






