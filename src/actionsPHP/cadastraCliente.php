

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/modal.css">
    <title>Cadastra Cliente</title>
</head>
<body>
    <?php
require_once '../models/clienteEnderecoModel.php';
require_once '../models/clienteModel.php';
require_once '../models/enderecoModel.php';
require_once '../conection/conexao.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

$pdo = Conexao::conecta();
$clienteCadastrado = 0;
$mensagemDeErro = '';
$senhaHash = $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

try{
    $pdo->beginTransaction();
    

    $cliente = new ClienteModel($id_cliente = null, $nome, $email, $telefone, $cpf, $senhaHash);
    $id_cliente =  $cliente->inserirCliente()->getId();

    $endereco = new EnderecoModel(null,$cep, $rua, $numero, $bairro, $cidade, $estado, $complemento);
    $id_endereco =  $endereco->inserirEndereco()->getId();

    $clienteEndereco = new ClienteEnderecoModel($id_cliente, $id_endereco);
    $id_cliente_endereco =  $clienteEndereco->inserirClienteEndereco();

    if($id_cliente == null || $id_endereco == null || $id_cliente_endereco == null){
        throw new PDOException("Error Processing Request", 1);
    }

    
    $pdo->commit();
    $clienteCadastrado = 1;
}catch (PDOException $e){
    if($e->errorInfo[1] == 1062){
        if(str_contains($e->getMessage(), 'email')){
            $mensagemDeErro = "Este email já está cadastrado no nosso banco de dados, <a href='../login.php'> tente logar aqui</a>";
            $pdo->rollBack();
            $clienteCadastrado = 2;
        }else if(str_contains($e->getMessage(),'cpf')){
            $mensagemDeErro = "Este cpf já está cadastrado no nosso banco de dados, <a href='../login.php'> tente logar aqui</a>";
            $pdo->rollBack();
            $clienteCadastrado = 2;
        }else{
            $mensagemDeErro = "Erro dados duplicados";
            $pdo->rollBack();
            $clienteCadastrado = 2;
        }
    }else{
        $mensagemDeErro = "erro inesperado: ".$e->getMessage();
        $pdo->rollBack();
        $clienteCadastrado = 2;
    }
}catch (RuntimeException $e){
    $mensagemDeErro = "Ocorreu um erro: ".$e->getMessage();
    $pdo->rollBack();
    $clienteCadastrado = 2;
}

if($clienteCadastrado == 1){
    echo'
    <dialog>
        <h1>Dados Salvos com sucesso</h1>
        <a href="../index.php">
            <button>Sair</button>
        </a>
    </dialog>
    
    ';
}else if ($clienteCadastrado == 2){
    echo'<dialog>
            <h1>Algo deu Errado :( </h1>
            <h3>'.$mensagemDeErro.'</h3>
            <a href="../index.php">
                <button>Sair</button>
            </a>
                <button onClick="window.history.back()">Voltar</button>
        </dialog>';
}


?>
    <script src="../javascript/scriptModal.js"></script>
</body>
</html>