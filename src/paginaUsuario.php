<?php
session_start();
require_once 'conection/conexao.php';
require_once 'models/clienteModel.php';
require_once 'models/enderecoModel.php';
require_once 'models/clienteEnderecoModel.php';
require_once 'models/produtoModel.php';
require_once 'models/itemModel.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/header2.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/testimonials.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/paginaUser.css">
    <title>Página de Usuário</title>

</head>
<body>
    <?php
if($_SESSION['id_cliente']==null){
    header("Location: login.php");
}
require_once 'header.php';
$nome = $_SESSION['nome'];
$idCliente = $_SESSION['id_cliente'];

$enderecos = ClienteEnderecoModel::buscarEnderecoPorIdDoCliente($idCliente);

$todosOsEnderecos = [];
foreach($enderecos as $idEndereco){
    $todosOsEnderecos[] = EnderecoModel::procurarEnderecoPorId($idEndereco);
}
echo "<h1>Meus dados</h1>";
$cliente = ClienteModel::verClientePorId($idCliente);
echo '<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>CPF</th><th>Funções</th>
    </tr>';

            $idVar = $cliente->getId();
            $clienteJSON = $cliente->clienteJSON($cliente);
            echo'<tr>
                <td>'.$cliente->getId().'</td>
                <td>'.$cliente->getNome().'</td>
                <td>'.$cliente->getEmail().'</td>
                <td>'.$cliente->getTelefone().'</td>
                <td>'.$cliente->getCpf().'</td>
                <td>
                    <form  method="POST" action="actionsPHP/editaCliente.php">
                        <input type="hidden" name="dados" value="'.htmlspecialchars($idCliente).'"></input>
                        <button type="submit">editar</button>
                    </form>
                </td>
                </tr>
            ';
        ; 
        echo'</table>';



   


echo "<br><h1>Meus endereços</h1>";
    echo'
            <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
                <tr>
                    <th>Cep</th><th>logradouro</th><th>Número</th><th>Complemento</th><th>Bairro</th><th>Cidade</th><th>Estado</th><th>Funções</th>
                </tr>
    ';
    foreach($todosOsEnderecos as $endereco){
        $idVar = $endereco->getId() ?? null;
        echo'
            <tr>
            <td>'.$endereco->getCep().'</td>
            <td>'.$endereco->getRua().'</td>
            <td>'.$endereco->getNumero().'</td>
            <td>'.$endereco->getComplemento().'</td>
            <td>'.$endereco->getBairro().'</td>
            <td>'.$endereco->getCidade().'</td>
            <td>'.$endereco->getEstado().'</td>
            <td>
                <form method="post" action="actionsPHP/editaEndereco.php">
                    <input type="hidden" id="dados" name="dados" value="'.$idVar.'">
                    <button type="submit">Editar</button> 
                </form>
            </td>
            </tr>
        ';
    }
    echo'</table>'
    
    
 ;

echo'
    <form method="post" action="actionsPHP/adicionaEndereco.php">
        <input type="hidden" id="id" name="id" value="'.$_SESSION['id_cliente'].'">
        <button type="submit">Adicionar</button> 
    </form><br>';


    echo'<h1>Meus Pedidos</h1>';
$idCliente = $_SESSION['id_cliente'];
$pedidos = ClienteModel::verPedidoPorCliente($idCliente);
$cliente = ClienteModel::verClientePorId($idCliente);

$idsPedidos = [];
foreach($pedidos as $pedido){
    $id = $pedido->getId();
    $idsPedidos[] = $id;
}

if($pedidos != null){
    foreach($pedidos as $pedido){
    echo'<b>Pedido '.$pedido->getId().'</b><br>';
    $idEndereco = $pedido->getEndereco();
    $endereco = EnderecoModel::procurarEnderecoPorId($idEndereco);
    
    echo'Endereco Cep: '.$endereco->getCep().',
    '.$endereco->getRua().'
    '.$endereco->getNumero().',
    '.$endereco->getBairro().'<br>';
    
    $data = new DateTime($pedido->getDataPedido());
    echo 'Data: ' . $data->format('d/m/Y H:i') . '<br>';
    echo'
        <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;" >
    <tr>
        <th>Produto</th><th>Quantidade</th><th>Preço</th>
    </tr>';
    $precoTotal = 0.0;
    $items = ItemModel::verPedidoPorId($pedido->getId());
    foreach($items as $item){
        $precoTotal += $item->getPrecoUnitario();
        $produto = ProdutoModel::verProdutoPorId($item->getProduto());
        echo'<tr>
                <td>'.$produto->getNome().'</td>
                <td>'.$item->getQuantidade().'</td>
                <td>'.$item->getPrecoUnitario().'</td>
            </tr>
        ';
    }
    $precoFormatado = number_format($precoTotal, 2, ',', '.');
    echo'</table>';
    echo"<b>Preço Total: R$ $precoFormatado </b><br><br><br>";
}

}else{
    echo'Este cliente não tem pedidos';
}

?>
    <a href="index.php">
    <button>Página Inicial</button>
</a>
  <a href="logout.php">
    <button>
        Deslogar
        <i class="fa-solid fa-right-from-bracket"></i>    
    </button>
    </a>

    
</body>
<?php require_once 'footer.php'; ?>
</html>


