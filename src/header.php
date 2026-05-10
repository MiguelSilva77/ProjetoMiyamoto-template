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
                    <a href="/index.php">Início</a>
                </li>
                <li class="nav-item">
                    <a href="/index.php#menu">Cardápio</a>
                </li>
                <li class="nav-item">
                    <a href="/index.php#testimonials">Avaliações</a>
                </li>
                <li class="nav-item">
                    <a href="carrinho.php">carrinho
                        <i class="fa-solid fa-basket-shopping"></i>
                        <?php
                        if(isset($_SESSION['totalDeItens'])){
                            echo $_SESSION['totalDeItens'];
                        }
                        ?>
                    </a>
                </li>
            </ul>

            <div style="display: flex;">
            
               <?php
            if(isset($_SESSION['id_cliente'])){
                echo'
                <a href="paginaUsuario.php">
                    <button class="btn-default-hea">
                    User 
                    <i class="fa-solid fa-user"></i>
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
                    <span class="material-symbols-outlined">
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