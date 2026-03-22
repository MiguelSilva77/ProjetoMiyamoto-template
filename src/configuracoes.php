<!-- Criador Miguel Silva -->

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
    <link rel="stylesheet" href="styles/loginColaboradores.css">
    <title>Configurações</title>
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
                    <a href="#home">Início</a>
                </li>
                <li class="nav-item">
                    <a href="#menu">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="#testimonials">Avaliações</a>
                </li>
            </ul>

            <a href="login.php">
                 <button class="btn-default" >
                Login
                </button>
            </a>
        </div>
    </header>
    <div>
        <div class="containerGrande">
     <div class="container">
        <label class="loginColaboradores">Login para colaboradores</label>
        <img src="images/logo.png" class="img" >

        <form action="actionsPHP/logaFuncionario.php" method="post">
            <div class="input-group">
                <label for="nome">Informe o seu nome</label>
                <input type="text" id="nome" name="nome" placeholder="Informe o seu nome">
            
            <div class="input-group">
                <label for="email">Informe o seu e-mail corporativo</label>
                <input type="email" id="email" name="email" placeholder="Informe o seu e-mail">
        </div>

        <div class="input-group">
            <label for="senha">Informe a sua senha corporativa</label>
            <input type="password" id="senha" name="senha" placeholder="Informe a sua senha">
        </div>

        <a href="config.php">teste</a>
        <input type="submit" name="continuar" id="continuar" class="btn" value="Continuar">
        </form>
        </div>
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
    
</body>
</html>