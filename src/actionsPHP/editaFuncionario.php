<?php
session_start();
require_once '../models/funcionarioModel.php';
require_once '../conection/conexao.php';

if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: index.php');
    exit;
}

$idFuncionario = $_POST['id'] ?? null;
$funcionario = null;

$nomeAlterado = $_POST['nomeAlterado'] ?? null;
$alteracaoRealizada = 0;
$mensagemDeErro = "";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/modal.css">
    <title>Edita Funncionário</title>
</head>
<body>

<?php
if($nomeAlterado == null){
    $funcionario = funcionarioModel::verFuncionarioPorId($idFuncionario);
    echo'
    <h1>Altere os Dados que deseja atualizar</h1>
    <form action="" method="post" onsubmit="return confirm(\'Atualizar Dados?\')>
        <label for="nome">nome:</label>
        <input type="text" id="nomeAlterado" name="nomeAlterado" value="'.$funcionario->getNome().'" required>

        <label for="email">email:</label>
        <input type="email" id="emailAlterado" name="emailAlterado" value="'.$funcionario->getEmail().'"required>

        <input type="hidden" name="idAlterado" value="'.$funcionario->getId().'">
        <input type="hidden" name="dataAltaerada" value="'.$funcionario->getDataCadastro().'">
        <input type="hidden" name="modficacaoAlterada" value="'.$funcionario->getUltimaModificacao().'">

        <button type="submit" onClick="return confirm(\"Atualizar Dados?\")">Atualizar</button>
    </form>
';
}else{

    $emailAlterado = $_POST['emailAlterado'] ?? null;       
    $idAlterada = $_POST['idAlterado'] ?? null; 
    $dataAlterada = $_POST['dataAltaerada'] ?? null;
    $modificacaoAlterada = $_POST['modficacaoAlterada'] ?? null;
    $pdo = Conexao::conecta();

    if($nomeAlterado != null){
    $funcionarioAlterado = new funcionarioModel($idAlterada, $nomeAlterado, $emailAlterado, $dataAlterada, $modificacaoAlterada);
    
    try{
        $pdo->beginTransaction();
        $funcionarioAlterado->editaFuncionario($funcionarioAlterado);
        $pdo->commit();
        $alteracaoRealizada = 1;
    }catch(PDOException $e){
        if(str_contains($e->getMessage(), 'email')){
            $mensagemDeErro = "Este email já está cadastrado no nosso banco de dados, <a href='../configuracoes.php'> tente logar aqui</a>";
            $alteracaoRealizada = 2;
            $pdo->rollBack();
        }else{
            $mensagemDeErro = "Erro dados duplicados".$e->getMessage() ;
            $alteracaoRealizada = 2;
            $pdo->rollBack();
        }
    }catch(RuntimeException $e){
        $mensagemDeErro = "Ocorreu um erro: ".$e->getMessage();
        $pdo->rollBack();
        $alteracaoRealizada = 2;
    }catch(Exception $e){
        $mensagemDeErro = "Ocorreu um erro: ".$e->getMessage();
        $pdo->rollBack();
        $alteracaoRealizada = 2;
    }

     if($alteracaoRealizada == 1){
        echo'
        <dialog>
            <h1>Dados Salvos com sucesso</h1>
            <a href="../config.php">
                <button>Sair</button>
            </a>
        </dialog>
    
        ';
    }else if ($alteracaoRealizada == 2){
        echo'<dialog>
            <h1>Algo deu Errado :( </h1>
            <h3>'.$mensagemDeErro.'</h3>
            <a href="../config.php">
                <button>Sair</button>
            </a>
                <button onClick="window.history.back()">Voltar</button>
        </dialog>';
    }
}

}


?>
    <script src="../javascript/scriptModal.js"></script>
</body>
</html>