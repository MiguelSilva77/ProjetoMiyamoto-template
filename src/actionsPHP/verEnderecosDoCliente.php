<?php
session_start();
require_once '../models/clienteEnderecoModel.php';
require_once '../models/clienteModel.php';
require_once '../models/enderecoModel.php';
require_once '../conection/conexao.php';

if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endereços</title>
</head>
<body>

<?php
$idCliente = $_POST['idCliente'] ?? null;
$idEnderecos = ClienteEnderecoModel::buscarEnderecoPorIdDoCliente($idCliente);
$enderecos = [];
$cliente = ClienteModel::verClientePorId($idCliente);

foreach($idEnderecos as $id){
    $endereco = EnderecoModel::procurarEnderecoPorId($id);
    $enderecos[] = $endereco;
}

echo'<h1>Endereços de '.$cliente->getNome().'</h1>';
   echo'
        <form method="post" action="actionsPHP/adicionaPedido.php">
            <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
                <tr>
                    <th>Cep</th><th>logradouro</th><th>Número</th><th>Complemento</th><th>Bairro</th><th>Cidade</th><th>Estado</th>
                </tr>
    ';
    foreach($enderecos as $endereco){
        echo'
            <tr>
            <td>'.$endereco->getCep().'</td>
            <td>'.$endereco->getRua().'</td>
            <td>'.$endereco->getNumero().'</td>
            <td>'.$endereco->getComplemento().'</td>
            <td>'.$endereco->getBairro().'</td>
            <td>'.$endereco->getCidade().'</td>
            <td>'.$endereco->getEstado().'</td>
            </tr>
        ';
    }
    echo'</table>';

?>
<a href="/config.php">
    <button type="button">Voltar</button>
</a>
</body>
</html>




