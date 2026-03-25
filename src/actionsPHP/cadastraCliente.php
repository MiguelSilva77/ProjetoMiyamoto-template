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

echo "nome $nome <br> email $email <br> telefone $telefone <br> cpf $cpf <br> senha $senha <br>
cep $cep <br> rua $rua <br> numero $numero <br> complemento $complemento <br> bairro $bairro <br>
cidade $cidade <br> estado $estado <br><br>";

$pdo = Conexao::conecta();

try{
    $pdo->beginTransaction();

    $cliente = new ClienteModel($nome, $email, $telefone, $cpf, $senha);
    $id_cliente =  $cliente->inserirCliente()->getId();

    $endereco = new EnderecoModel($cep, $rua, $numero, $complemento, $bairro, $cidade, $estado);
    $id_endereco =  $endereco->inserirEndereco()->getId();

    $clienteEndereco = new ClienteEnderecoModel($id_cliente, $id_endereco);
    $id_cliente_endereco =  $clienteEndereco->inserirClienteEndereco();

    if($id_cliente == null || $id_endereco == null || $id_cliente_endereco == null){
        throw new PDOException("Error Processing Request", 1);
    }

    $pdo->commit();
}catch (PDOException $e){
    if($e->errorInfo[1] == 1062){
        if(str_contains($e->getMessage(), 'email')){
            echo "Este email já está cadastrado no nosso banco de dados, <a href='../login.php'> tente logar aqui</a>";
            $pdo->rollBack();
        }else if(str_contains($e->getMessage(),'cpf')){
            echo "Este cpf já está cadastrado no nosso banco de dados, <a href='../login.php'> tente logar aqui</a>";
            $pdo->rollBack();
        }else{
            echo "Erro duplicados";
            $pdo->rollBack();
        }
    }else{
        echo "erro inespérado: ".$e->getMessage();
        $pdo->rollBack();
    }
}catch (RuntimeException $e){
    echo "Ocorreu um erro: ".$e->getMessage();
    $pdo->rollBack();
}

echo"<br> <b>All clients Registered </b><br>";
$todosOsCliente = ClienteModel::verTodosOsClientes();
foreach($todosOsCliente as $cliente){
    echo $cliente. "<br>";
}

echo"<br> <b>All address Registered </b><br>";
$todosOsEnderecos = EnderecoModel::buscarTodosOsEnderecos();
foreach($todosOsEnderecos as $endereco){
    echo $endereco. "<br>";
}


?>