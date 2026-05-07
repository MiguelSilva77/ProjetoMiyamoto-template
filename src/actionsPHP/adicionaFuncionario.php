<?php
session_start();
require_once '../models/funcionarioModel.php';
require_once '../conection/conexao.php';

if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: index.php');
    exit;
}

$nome = $_POST['nome'] ?? null;
$email = $_POST['email'] ?? null; 
$senha = $_POST['senha'] ?? null;
$mensagemDeErro = "";
$funcionarioCadastraddo = 0;

if($nome != null && $email != null && $senha != null){
    $funcionario = new funcionarioModel(null, $nome, $email, $senha, null, null);
    $pdo = Conexao::conecta();
    try{
        $pdo->beginTransaction();
        $funcionario->inserirFuncionário();
        $pdo->commit();
        $funcionarioCadastraddo = 1;
    }catch(PDOException $e){
        if(str_contains($e->getMessage(), 'email')){
            $mensagemDeErro = "Este email já está cadastrado no nosso banco de dados, <a href='../configuracoes.php'> tente logar aqui</a>";
            $funcionarioCadastraddo = 2;
            $pdo->rollBack();
        }else{
            $mensagemDeErro = "Erro dados duplicados".$e->getMessage() ;
            $funcionarioCadastraddo = 2;
            $pdo->rollBack();
        }
    }catch(RuntimeException $e){
        $mensagemDeErro = "Ocorreu um erro: ".$e->getMessage();
        $pdo->rollBack();
        $funcionarioCadastraddo = 2;
    }catch(Exception $e){
        $mensagemDeErro = "Ocorreu um erro: ".$e->getMessage();
        $pdo->rollBack();
        $funcionarioCadastraddo = 2;
    }

    if($funcionarioCadastraddo == 1){
        echo'
        <dialog>
            <h1>Dados Salvos com sucesso</h1>
            <a href="../config.php">
                <button>Sair</button>
            </a>
        </dialog>
    
        ';
    }else if ($funcionarioCadastraddo == 2){
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





?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/modal.css">
    <title>Adiciona Funcionário</title>
</head>
<body>
    <h1>cadastre o novo funcionário</h1>
    <form action="" method="post">
            <label for="nome">nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">email:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Cidade:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit" class="btn-cadastrar">Cadastrar</button>
    </form>

    <script src="../javascript/scriptModal.js"></script>
</body>
</html>


