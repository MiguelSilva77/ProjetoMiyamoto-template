<?php
session_start();
require_once 'conection/conexao.php';
require_once 'models/clienteModel.php';
require_once 'models/enderecoModel.php';
require_once 'models/clienteEnderecoModel.php';

if($_SESSION['id_cliente']==null){
    header("Location: login.php");
}

$nome = $_SESSION['nome'];
$idCliente = $_SESSION['id_cliente'];

$enderecos = ClienteEnderecoModel::buscarEnderecoPorIdDoCliente($idCliente);
var_dump($enderecos);

$todosOsEnderecos = [];
foreach($enderecos as $idEndereco){
    $todosOsEnderecos[] = EnderecoModel::procurarEnderecoPorId($idEndereco);
}
echo "<h1>Meus dados</h1>";
$cliente = ClienteModel::verClientePorId($idCliente);
echo $cliente.'
    <form  method="POST" action="actionsPHP/editaCliente.php">
        <input type="hidden" name="dados" value="'.htmlspecialchars($idCliente).'"></input>
        <button type="submit">editar</button>
    </form>';


echo "<h1>Meus endereços</h1>";
foreach($todosOsEnderecos as $endereco){
    $idVar = $endereco->getId();
    echo $endereco.
    '<form method="post" action="actionsPHP/editaEndereco.php">
        <input type="hidden" id="dados" name="dados" value="'.$idVar.'">
        <button type="submit">Editar</button> 
    </form>';
}
echo'<button>Adicionar Endereço</button>';

?>

