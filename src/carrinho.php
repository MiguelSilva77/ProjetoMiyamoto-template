<?php
session_start();
if(!isset($_SESSION['totalDeItens'])){
    $_SESSION['totalDeItens'] = 0;
}
if(!isset($_SESSION['items'])){
    $_SESSION['items'] = [];
}

$idCliente = $_SESSION['idCliente'] ?? null;

$valorTotal = 0;
$idProduto = null;
    
if(isset($_POST['cliente']) && isset($_POST['produto'])){
    $idCliente = $_POST['cliente'];
    $idProduto = $_POST['produto'];
    $_SESSION['totalDeItens'] ++ ;
    $_SESSION['items'][] = $idProduto;
    $_SESSION['idCliente'] = $idCliente;


    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
require_once 'conection/conexao.php';
require_once 'models/produtoModel.php';
require_once 'models/enderecoModel.php';
require_once 'models/clienteModel.php';
require_once 'models/clienteEnderecoModel.php';
require_once 'models/itemModel.php';
require_once 'models/pedidoModel.php';

if(!isset($_SESSION['id_cliente'])|| $_SESSION['id_cliente'] == null){
   echo "<script>alert('Login não realizado, entre com seu usuário e senha para continuar a operação'); window.location.href='../login.php';</script>";
exit;

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/testimonials.css">
    <link rel="stylesheet" href="styles/footer.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Carrinho</title>
</head>
<body>
     <header>
        <nav id="navbar">
            <?php
            if(isset($_SESSION['nome'])){
                $nome = $_SESSION['nome'];
                echo'<i class="fa-solid fa-burger" id="nav_logo"> Olá <br>'.explode(" ", $nome)[0].'</i>';
            }else{
                echo'<i class="fa-solid fa-burger" id="nav_logo"> Miyamoto <br>food</i>';
            }
            ?>

            <ul id="nav_list">
                <li class="nav-item active">
                    <a href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a href="index.php">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="index.php">Avaliações</a>
                </li>
                    <a href="carrinho.php">carrinho
                        <i class="fa-solid fa-basket-shopping"></i>
                        <?php echo $_SESSION['totalDeItens']?>
                    </a>
            </ul>

            <div style="display: flex;">
            
               <?php
            if(isset($_SESSION['id_cliente'])){
                echo'
                <a href="paginaUsuario.php">
                    <button class="btn-default-hea" >
                    Login
                    </button>
                </a>
                ';
            }else{
                echo'
                <a href="login.php">
                    <button class="btn-default-hea" >
                    Login
                    </button>
                </a>
                ';
            }

            if(isset($_SESSION['id'])){
                echo'
                    <a href="config.php">
                        <button class="btn-default-hea" >
                        Config
                        </button>
                    </a>
                ';
            }else{
              echo'
                    <a href="configuracoes.php">
                        <button class="btn-default-hea" >
                        Config
                        </button>
                    </a>
                ';  
            }
            
            ?>

            

            </div>
           

            <button id="mobile_btn">
                <i class="fa-solid fa-bars"></i>
            </button>
        </nav>

        <div id="mobile_menu">
            <ul id="mobile_nav_list">
                <li class="nav-item">
                    <a href="index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a href="index.php">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="index.php">Avaliações</a>
                </li>
            </ul>

            <?php
            if(isset($_SESSION['id_cliente'])){
                echo'
                <a href="paginaUsuario.php">
                    <button class="btn-default" >
                    Login
                    </button>
                </a>
                ';
            }else{
                echo'
                <a href="login.php">
                    <button class="btn-default" >
                    Login
                    </button>
                </a>
                ';
            }
            
            ?>

           
        </div>
    </header>

    <?php
    if($_SESSION['totalDeItens'] > 0){
        $todosOsProdutos = [];
    foreach($_SESSION['items'] as $idProduto){
        $produto = ProdutoModel::verProdutoPorId($idProduto);
        $todosOsProdutos[] = $produto;
    }

    echo'<h1>itens no seu Carrinho</h1>';
   
    echo'
    <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
        <tr>
            <th>Item</th><th>Descrição</th><th>Preço</th><th>Funções</th>
        </tr>
    ';
    foreach($todosOsProdutos as $produto){
        $valorTotal += $produto->getPreco();
        echo'
            <tr>
            <td>'.$produto->getNome().'</td>
            <td>'.$produto->getDescricao().'</td>
            <td>'.$produto->getPreco().'</td>
            <td>
                <button>Excluir</button>
            </td>
            </tr>
        ';
    }
    echo'</table>';

    echo $_SESSION['totalDeItens'];
    var_dump($_SESSION['idCliente']);
    $idEnderecos = ClienteEnderecoModel::buscarEnderecoPorIdDoCliente($_SESSION['idCliente']);
    $enderecos = [];
    foreach($idEnderecos as $id){
        $endereco = EnderecoModel::procurarEnderecoPorId($id);
        $enderecos[] = $endereco;
    }

    echo'<h1>Seus Endereços</h1>';
   echo'
        <form method="post" action="actionsPHP/adicionaPedido.php">
            <input type="hidden" name="cliente" id="cliente" value="'.$_SESSION['idCliente'].'">
   
            <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
                <tr>
                    <th>escolha</th><th>Rua</th><th>Número</th><th>Bairro</th><th>Complemento</th>
                </tr>
    ';
    $indice = 0;
    foreach($enderecos as $endereco){
        $indice ++;
        $check = ($indice == 1) ? 'checked':' ';
        echo'
            <tr>
            <td>
                <input type="radio" name="enderecoEscolha" value="'.$endereco->getId().'"'.$check.'> 
            </td>
            <td>'.$endereco->getRua().'</td>
            <td>'.$endereco->getNumero().'</td>
            <td>'.$endereco->getBairro().'</td>
            <td>
                <button>Excluir</button>
            </td>
            </tr>
        ';
    }
    echo'
                </table>
            <button type="submit">Comprar</button>
        </form>';
    }else{
        echo'<h1>Carrrinho Vazio</h1>';
    }
    
    ?>

    <footer>
        <img src="images/wave.svg" alt="">

        <div id="footer_items">
            <span id="copyright">
                &copy 2026 miyamoto company
            </span>

            <div class="social-media-buttons">
                <a href="">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

                <a href="">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>
    </footer>
    <script src="javascript/script.js"></script>
    
</body>
</html>