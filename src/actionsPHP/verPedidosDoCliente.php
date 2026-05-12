<?php
session_start();

if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: index.php');
    exit;
}
require_once '../models/clienteModel.php';
require_once '../models/produtoModel.php';
require_once '../models/enderecoModel.php';
require_once '../conection/conexao.php';
require_once '../models/itemModel.php';
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
    <title>Pedidos</title>
</head>
<body>
    <main>
        <?php
        require_once '../header.php';

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
            echo'<b>Pedido '.$pedido->getId().'</b><br>';
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
            $precoFormatado = number_format($precoTotal, 2, ',', '.');
            echo'</table>';
            echo"Preço Total: <b>R$ $precoFormatado</b><br><br><br>";
        }

        }else{
            echo'Este cliente não tem pedidos';
        }

        ?>
    <a href="../config.php">
        <button type="button">Voltar</button>
    </a>
    </main>
    <?php require_once '../footer.php'; ?>
    
</body>
</html>


