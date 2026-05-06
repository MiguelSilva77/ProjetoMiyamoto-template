<?php
require_once '../models/clienteModel.php';
require_once '../models/produtoModel.php';
require_once '../models/enderecoModel.php';
require_once '../conection/conexao.php';
require_once '../models/itemModel.php';

$idCliente = $_POST['idCliente'];
$pedidos = ClienteModel::verPedidoPorCliente($idCliente);
$cliente = ClienteModel::verClientePorId($idCliente);

$idsPedidos = [];
foreach($pedidos as $pedido){
    $id = $pedido->getId();
    $idsPedidos[] = $id;
}

echo'<h3>Cliente '.$cliente->getNome().'</h3><br>';
if($pedidos != null){
    foreach($pedidos as $pedido){
    echo'Pedido '.$pedido->getId().'<br>';
    $idEndereco = $pedido->getEndereco();
    $endereco = EnderecoModel::procurarEnderecoPorId($idEndereco);
    
    echo'Endereco Cep: '.$endereco->getCep().',
    Logradouro:'.$endereco->getRua().',
    Número: '.$endereco->getNumero().',
    Bairro: '.$endereco->getBairro().'<br>';
    
    echo'Data: '.$pedido->getDataPedido().'<br>';
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