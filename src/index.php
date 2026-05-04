<?php
session_start();
?>
<!-- Criador Pedro Vidal -->

<!DOCTYPE html>
<html lang="pt-br">
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
    <title>Miyamoto</title>
</head>
<body>
    <header>
        <nav id="navbar">
            <?php
            //echo var_export($_SESSION);
            if(isset($_SESSION['nome'])){
                $nome = $_SESSION['nome'];
                echo'<i class="fa-solid fa-burger" id="nav_logo"> Olá <br>'.explode(" ", $nome)[0].'</i>';
            }else{
                echo'<i class="fa-solid fa-burger" id="nav_logo"> Miyamoto <br>food</i>';
            }
            ?>

            <ul id="nav_list">
                <li class="nav-item active">
                    <a href="#home">Início</a>
                </li>
                <li class="nav-item">
                    <a href="#menu">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="#testimonials">Avaliações</a>
                </li>
                <li class="nav-item">
                    <a href="carrinho.php">Carrinho</a>
                </li>
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
                    <a href="#home">Início</a>
                </li>
                <li class="nav-item">
                    <a href="#menu">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="#testimonials">Avaliações</a>
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

    <main id="content">
        <section id="home">
            <div class="shape"></div>
            <div id="cta">
                <h1 class="title">
                    O toque oriental
                    <span>que faltava no seu dia</span>
                </h1>

                <p class="description">
                    Delicadeza, tradição e sabor em cada pedacinho. 
                    Saboreie a arte milenar da culinária japonesa com ingredientes frescos e a perfeição dos mestres sushimen.
                </p>

                <div id="cta_buttons">
                    <a href="#" class="btn-default">
                        Ver cardápio
                    </a>

                    <a href="tel:+55555555555" id="phone_button">
                        <button class="btn-default">
                            <i class="fa-solid fa-phone"></i>
                        </button>
                        (11) 3342-2425
                    </a>
                </div>

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

            <div id="banner">
                <img src="images/hero.png" alt="">
            </div>
        </section>

        <section id="menu">
            <h2 class="section-title">Cardápio</h2>
            <h3 class="section-subtitle">Nossos pratos especiais</h3>

            <div id="dishes">
                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <img src="images/dish.png" class="dish-image" alt="">

                    <h3 class="dish-title">
                        Combinado de Sushi
                    </h3>

                    <span class="dish-description">
                        Um delicioso combinado com peças frescas e selecionadas, preparado com ingredientes
                        de alta qualidade. Ideal para quem quer saborear o melhor da culinária japonesa.
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(500+)</span>
                    </div>

                    <div class="dish-price">
                        <h4>R$35,00</h4>
                        <form action="carrinho.php" method="post">
                            <input type="hidden" value="5" name="produto" id="produto">
                            <input type="hidden" value="<?php echo @$_SESSION['id_cliente'] ?>" id="cliente" name="cliente">
                            <button type="submit" class="btn-default">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <img src="images/dish2.png" class="dish-image" alt="">

                    <h3 class="dish-title">
                        Temaki
                    </h3>

                    <span class="dish-description">
                        Um cone crocante de alga nori recheado generosamente 
                        com arroz temperado e ingredientes frescos.
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(500+)</span>
                    </div>

                    <div class="dish-price">
                        <h4>R$13,00</h4>
                        <form action="carrinho.php" method="post">
                            <input type="hidden" value="6" name="produto" id="produto">
                             <input type="hidden" value="<?php echo @$_SESSION['id_cliente'] ?>" id="cliente" name="cliente">
                            <button type="submit" class="btn-default">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </button>
                        </form>
                       
                    </div>
                </div>

                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <img src="images/dish3.png" class="dish-image" alt="">

                    <h3 class="dish-title">
                        Yakissoba 
                    </h3>

                    <span class="dish-description">
                        Tradicional macarrão oriental salteado no wok com legumes frescos — 
                        como brócolis, cenoura e repolho — combinado com tiras de carne, frango ou camarão.
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(500+)</span>
                    </div>

                    <div class="dish-price">
                        <h4>R$18,00</h4>
                       <form action="carrinho.php" method="post">
                            <input type="hidden" value="7" name="produto" id="produto">
                            <input type="hidden" value="<?php echo @$_SESSION['id_cliente'] ?>" id="cliente" name="cliente">
                            <button type="submit" class="btn-default">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="dish">
                    <div class="dish-heart">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <img src="images/dish4.png" class="dish-image" alt="">

                    <h3 class="dish-title">
                        Poke
                    </h3>

                    <span class="dish-description">
                        Tigela fresca com peixe marinado, arroz e toppings selecionados, 
                        unindo sabor, leveza e muita cor.
                    </span>

                    <div class="dish-rate">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>(500+)</span>
                    </div>

                    <div class="dish-price">
                        <h4>R$25,00</h4>
                        <form action="carrinho.php" method="post">
                            <input type="hidden" value="8" name="produto" id="produto">
                            <input type="hidden" value="<?php echo @$_SESSION['id_cliente'] ?>" id="cliente" name="cliente">
                            <button type="submit" class="btn-default">
                                <i class="fa-solid fa-basket-shopping"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials">
            <img src="images/chef.png" id="testimonial_chef" alt="">

            <div id="testimonials_content">
                <h2 class="section-title">
                    Depoimentos
                </h2>
                <h3 class="section-subtitle">
                    O que os clientes falam sobre nós
                </h3>

                <div id="feedbacks">
                    <div class="feedback">
                        <img src="images/avatar.png" class="feedback-avatar" alt="">

                        <div class="feedback-content">
                            <p>
                                Kenji Tanaka
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>
                                "O melhor sushi que já comi! O peixe estava incrivelmente fresco, e o serviço foi impecável.
                                Uma verdadeira viagem ao japão sem sair da cidade."
                            </p>
                        </div>
                    </div>

                    <div class="feedback">
                        <img src="images/avatar2.png" class="feedback-avatar" alt="">

                        <div class="feedback-content">
                            <p>
                                Sofia Mendes
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>
                                "Simplesmente maravilhoso! O temaki estava crocante e recheado na medida certa.
                                Ambiente super agradável e pratos preparados com muito cuidado."
                            </p>
                        </div>
                    </div>
                </div>

                <button class="btn-default">
                    Ver mais avaliações
                </button>
            </div>
        </section>
    </main>

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
