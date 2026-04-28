<?php
session_start();

if(!isset($_SESSION['id'])){
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/header2.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/testimonials.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/styles.css">
    <title>Configurações</title>
</head>
<body>

<div id="dadosPHP" class="dadosPHP">
    <?php
    require_once  __DIR__.'/models/clienteEnderecoModel.php';
    require_once  __DIR__.'/models/clienteModel.php';
    require_once  __DIR__.'/models/enderecoModel.php';
    require_once  __DIR__.'/models/funcionarioModel.php';
    require_once  __DIR__.'/models/produtoModel.php';

    $nome = $_SESSION['nome'] ?? null;
    echo"<h2>Olá $nome</h2>";

    echo"<br> <b>All clients Registered </b><br>";

    $todosOsCliente = ClienteModel::verTodosOsClientes();
    echo '<table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;">
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Telefone</th><th>CPF</th><th>Funções</th>
    </tr>';
        foreach($todosOsCliente as $cliente){
            $idVar = $cliente->getId();
            $clienteJSON = $cliente->clienteJSON($cliente);
            echo'<tr>
                <td>'.$cliente->getId().'</td>
                <td>'.$cliente->getNome().'</td>
                <td>'.$cliente->getEmail().'</td>
                <td>'.$cliente->getTelefone().'</td>
                <td>'.$cliente->getCpf().'</td>
                <td>
                    <button>Ver Pedidos</button>
                    <button>Ver Endereços</button>
                </td>
                </tr>
            ';
        }; 
        echo'</table>';

     echo"<br> <b>All emplyed Registered </b><br>";

   $todosOsFuncionarios = funcionarioModel::verTodosOsFuncionários();
   echo'
   <table <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;" >
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Data de Registro</th><th>Ultima Modificação</th><th>Funções</th>
    </tr>';
    foreach($todosOsFuncionarios as $funcionario){
        $idVar = $funcionario->getId();
        echo'<tr>
            <td>'.$funcionario->getId().'</td>
            <td>'.$funcionario->getNome().'</td>
            <td>'.$funcionario->getEmail().'</td>
            <td>'.$funcionario->getDataCadastro().'</td>
            <td>'.$funcionario->getUltimaModificacao().'</td>
            <td> 
                <form action="actionsPHP/deletaFuncionario.php" method="post" onsubmit="return confirm(\'Excluir?\')">
                    <input type="hidden" name ="id" id="id" value="'.$idVar.'"></input>
                    <button type="submit" onClick="return confirm(\"Excluir?\")" >excluir</button>
                </form>
                <button>editar</button>
                
            </td>
        </tr>';
    }
    echo'</table>';

$todosOsprodutos = ProdutoModel::verTodosOsProdutos();
echo"<br> <b>all products registered</b>";
     echo'
   <table <table border="1" width="100%" cellpadding="10" style="border-collapse: collapse;" >
    <tr>
        <th>ID</th><th>Nome</th><th>Preço</th><th>Descrição</th><th>Funções</th>
    </tr>';
   foreach($todosOsprodutos as $produto){
    $idVar = $produto->getId();
    echo'<tr>
        <td>'.$produto->getId().'</td>
        <td>'.$produto->getNome().'</td>
        <td>'.$produto->getPreco().'</td>
        <td>'.$produto->getDescricao().'</td>
        <td>Futuras funções aqui</td>
        </tr>
        ';
   }
    echo'</table>';
    echo' <a href="actionsPHP/adicionaProduto.php">
    <button>Adicionar Produto</button>
    </a>';
    ?>
</div>




    

    <a href="logout.php">
    <button>Sair</button>
    </a>;

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
</body>
</html>


