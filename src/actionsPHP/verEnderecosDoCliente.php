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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/header2.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="../styles/paginaUser.css">
    <title>Endereços</title>
</head>
<body>
    <main>

<?php
require_once '../header.php';
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
        <form method="post">
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
<a href="../config.php">
    <button type="button">Voltar</button>
</a>
</body>
</main>
<?php require_once '../footer.php'; ?>
</html>




