<!-- Criador Miguel Silva -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/header2.css">
    <link rel="stylesheet" href="styles/home.css">
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="stylesheet" href="styles/testimonials.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/cadastro.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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

            <a href="login.html">
                 <button class="btn-default" >
                Login
                </button>
            </a>
        </div>
    </header>

    </div>
    </div>
    <div class="containerGrande">
         <div class="container">
        <img src="images/logo.png" class="img" >
        <h2>Cadastro de Cliente</h2>
        <form action="actionsPHP/cadastraCliente.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>

          	<label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" maxlength="14" placeholder="(99)99999-9999" required>

            <label for="telefone">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="999.999.999-99" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="*******" required>

            <label>Endereço</label>

           <div class="linha-cep">
                <label for="cep">CEP:</label>
               
                    <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" class="nCEP">
                     Não sei meu cep
                    </a>
            </div>
            <input type="text" id="cep" name="cep" maxlength="9" placeholder="99999-999" required>
           

            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" placeholder="sua rua" required>

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" placeholder="ex:999" required>

            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" placeholder="bloco: 99 apto 99">

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" placeholder="seu bairro" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" placeholder="sua cidade" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" placeholder="seu estado" required>



            <button type="submit" class="btn-cadastrar" onClick="a">Cadastrar</button>
        </form>
         <a href="index.html">Voltar</a>
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
    <script src="javascript/viaCEP.js" defer></script>
    <script src="javascript/scriptCad.js" defer></script>
</body>
</html>