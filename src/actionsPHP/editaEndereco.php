<?php
session_start();

if($_SESSION['id_cliente']==null){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/header2.css">
    <link rel="stylesheet" href="../styles/modal.css">
    <link rel="stylesheet" href="../styles/editaEndereco.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> 
    <script src="../javascript/viaCEP.js" defer></script>
    <title>Edita Endereço</title>
</head>

<body>
    <main>
    <?php
    require_once '../models/clienteEnderecoModel.php';
    require_once '../models/clienteModel.php';
    require_once '../models/enderecoModel.php';
    require_once '../conection/conexao.php';
    require_once '../header.php';

    $pdo = Conexao::conecta();

    $ruaAlterada = $_POST['rua'] ?? null;
    $alteracaoRealizada = 0;
    $mensagemDeErro = '';

    if($ruaAlterada == null){
        $dados = $_POST['dados'];
        $endereco = EnderecoModel::procurarEnderecoPorId($dados);

        echo'
        <div class="containerGrande">
            <div class="container">
        <form action="" method="post">
            <input style="display: none;" type="text" name="id" id="id" value="'.$endereco->getId().'" >
            <label><h1>Altere os dados que deseja atualizar</h1></label>
            <label for="cep">CEP:</label>
                <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" class="nCEP">
                     Não sei meu cep
                </a>
            <input type="text" id="cep" name="cep" maxlength="9" value="'.$endereco->getCep().'" required>
        
            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" value="'.$endereco->getRua().'" required>

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" value="'.$endereco->getNumero().'"required>

            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" value="'.$endereco->getComplemento().'">

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" value="'.$endereco->getBairro().'" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="'.$endereco->getCidade().'" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" value="'.$endereco->getEstado().'" required>

            <button type="submit" class="btn-cadastrar">Cadastrar</button>
        </form>
    </div>
</div>';
    }else{
        $id = $_POST['id'];
        $cepAlterado = $_POST['cep'];
        $numeroAlterado = $_POST['numero'];
        $complementoAlterado = $_POST['complemento'];
        $bairroAlterado = $_POST['bairro'];
        $cidadeAlterada = $_POST['cidade'];
        $estadoAlterado = $_POST['estado'];

        $enderecoAlterado = new EnderecoModel($id, $cepAlterado, $ruaAlterada, $numeroAlterado, $bairroAlterado, $cidadeAlterada, $estadoAlterado, $complementoAlterado);

       try{  
        $pdo->beginTransaction();

        $idEnderecoAlterado = $enderecoAlterado->editaEndereco($enderecoAlterado);
        echo $idEnderecoAlterado;

        $pdo->commit();
        $alteracaoRealizada = 1;
       }catch(RuntimeException $e){
        echo $e->getMessage();
        $alteracaoRealizada = 2;
        $pdo->rollBack();
       }catch(Exception $e){
        echo $e->getMessage();
        $alteracaoRealizada = 2;
        $pdo->rollBack();
       }
    }

    if($alteracaoRealizada == 1){
           echo'<dialog>
            <h1>Dados Atualizados com sucesso</h1>
            <a href="../paginaUsuario.php">
                <button>Sair</button>
            </a>
        </dialog>';
    }else if($alteracaoRealizada == 2){
        echo'<dialog>
            <h1>Erro Dados não puderam ser atualizados</h1>
            <a href="../paginaUsuario.php">
                <button>Sair</button>
            </a>
        </dialog>';
    }



?>

</main>
<?php require_once '../footer.php'; ?>
<script src="../javascript/scriptModal.js"></script>
<script src="../javascript/viaCEP.js" defer></script> 
<script src="../javascript/scriptCad.js" defer></script>
</body>
</html>