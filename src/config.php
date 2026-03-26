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


    echo"<br> <b>All clients Registered </b><br>";
    $todosOsCliente = ClienteModel::verTodosOsClientes();
        foreach($todosOsCliente as $cliente){
            $idVar = $cliente->getId();
            echo $cliente.
        '<button onClick="editarCliente(' . $idVar . ')">editar</button><br>
        ';
    }

    echo"<br> <b>All address Registered </b><br>";  
    $todosOsEnderecos = EnderecoModel::buscarTodosOsEnderecos();
    foreach($todosOsEnderecos as $endereco){
        $idVar = $endereco->getId();
        echo $endereco.
        '<button onClick="editarCliente(' . $idVar . ')">editar</button><br>
        ';
    }





    $unicoCliente = ClienteModel::verClientePorId(1);
    echo "<br> <b>cliente unico </b>". $unicoCliente;

    ?>
</div>




    
    <a href="index.php">Voltar</a>
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


