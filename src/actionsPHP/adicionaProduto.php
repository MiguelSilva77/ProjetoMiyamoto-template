<?php
session_start();
require_once __DIR__.'/../conection/conexao.php';
require_once __DIR__.'/../models/produtoModel.php';
?>

<form action="" method="post">

<label for="nome">Nome</label>
<input type="text" name="nome" id="nome" maxlength="100">

<label for="preco">Preço</label>
<input type="number" name="preco" id="preco" step="0.01" min="0.01">

<label for="descricao">Descrição</label>
<input type="text" name="descricao" id="descricao" maxlength="200">

<button type="submit">cadastrar</button>

</form>


<script src="javascript/scriptAddProduto.js" defer></script>

<?php
if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];

    $produto = new ProdutoModel(null, $nome, $preco, $descricao);
    $idproduto = $produto->adicionaProduto()->getId();

    if(isset($idproduto)){
        echo' <alert>Produto inserido com sucesso</alert>';
    }else{
        echo' <alert>Erro ao inserir Produto</alert>';
    }
}

?>

<a href="../config.php">
    <button>Voltar</button>
</a>
