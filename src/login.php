<?php 
session_start();
require_once 'models/clienteModel.php';

$login = null;
$senha = null;

    if(isset($_POST['email'])&& isset ($_POST['senha'])){
    
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $cliente = ClienteModel::logaCliente($email, $senha);
        
        if($cliente){
            $_SESSION['nome'] = $cliente['nome'];
            $_SESSION['id_cliente'] = $cliente['id_cliente'];
            header("Location: paginaUsuario.php");
        }else{
            echo'cliente não encontrado';
        }
           
            
      

        
    }


    



?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/header2.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/testimonials.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
        <header>
        <nav id="navbar">
            <i class="fa-solid fa-burger" id="nav_logo"> food</i>

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
            </ul>

            <div class="botoesHeader"> 
                 <a href="login.php">
                 <button class="btn-default-hea" >
                Login
                </button>
            </a>

            <a href="configuracoes.php">
                 <button class="btn-default-hea" >
                Config
                </button>
            </a>

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

            <a href="login.html">
                 <button class="btn-default" >
                Login
                </button>
            </a>
        </div>
    </header>
    
<div class="containerGrande">
     <div class="container">
        <img src="images/logo.png" class="img" >

        <form action="" method="post">
             <div class="input-group">
            <label for="email">Informe o seu e-mail</label>
            <input type="email" id="email" name="email" placeholder="Informe o seu e-mail">
        </div>

        <div class="input-group">
            <label for="senha">Informe a sua senha</label>
            <input type="password" id="senha" name="senha" placeholder="Informe a sua senha">
        </div>
        <input type="submit" name="continuar" id="continuar" class="btn" value="Continuar">
        </form>
       

        <p>Ou escolha a opção</p>

        <div class="social-btn">
            <button class="google">
                <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google"> Continuar com Google
            </button>
            <button class="facebook">
                <img src="https://img.icons8.com/ios-filled/50/ffffff/facebook.png" alt="Facebook"> Continuar com Facebook
            </button>
        </div>

        <p>Não tem conta? <a href="cadastro.php" class="link">Criar conta</a></p>
    </div>
</div>
   
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

  

</html>
</body>
</html>