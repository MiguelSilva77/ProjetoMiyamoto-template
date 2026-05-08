<?php
session_start();
require_once 'conection/conexao.php';
require_once 'models/clienteModel.php';
require_once 'models/enderecoModel.php';
require_once 'models/clienteEnderecoModel.php';
require_once 'models/produtoModel.php';
require_once 'models/itemModel.php';

if($_SESSION['id_cliente']==null){
    header("Location: login.php");
}

$nome = $_SESSION['nome'];
$idCliente = $_SESSION['id_cliente'];

$enderecos = ClienteEnderecoModel::buscarEnderecoPorIdDoCliente($idCliente);

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
    $idVar = $endereco->getId() ?? null;
    echo $endereco.
    '<form method="post" action="actionsPHP/editaEndereco.php">
        <input type="hidden" id="dados" name="dados" value="'.$idVar.'">
        <button type="submit">Editar</button> 
    </form>';
}
echo'
    <form method="post" action="actionsPHP/adicionaEndereco.php">
        <input type="hidden" id="id" name="id" value="'.$_SESSION['id_cliente'].'">
        <button type="submit">Adicionar</button> 
    </form>';;


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
    echo'Pedido '.$pedido->getId().'<br>';
    $idEndereco = $pedido->getEndereco();
    $endereco = EnderecoModel::procurarEnderecoPorId($idEndereco);
    
    echo'Endereco Cep: '.$endereco->getCep().',
    Logradouro:'.$endereco->getRua().',
    Número: '.$endereco->getNumero().',
    Bairro: '.$endereco->getBairro().'<br>';
    
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
    echo'</table>';
    echo"Preço Total: R$$precoTotal  <br><br><br>";
}

}else{
    echo'Este cliente não tem pedidos';
}
?>

<a href="index.php">
    <button>Página Inicial</button>
</a>
  <a href="logout.php">
    <button>Deslogar</button>
    </a>


