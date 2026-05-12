<?php
session_start();
require_once '../conection/conexao.php';
require_once '../models/clienteModel.php';
require_once '../models/enderecoModel.php';
require_once '../models/clienteEnderecoModel.php';

if($_SESSION['id_cliente']==null){
    header("Location: login.php");
}

$idCliente = $_POST['id'];
$rua = $_POST['rua'] ?? null;
$enderecoCadastrado = 0;


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../styles/styles.css">
    <link rel="stylesheet" href="../styles/header2.css">
    <link rel="stylesheet" href="../styles/modal.css">
    <link rel="stylesheet" href="../styles/editaEndereco.css">
    <link rel="stylesheet" href="../styles/footer.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Adiciona Endereço</title>
</head>
<body>
    <main>
    <?php
    require_once '../header.php';
    if($rua == null){
     echo'
     <div class="containerGrande">
        <div class="container">
    <form action="" method="post">
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
            
            <input type="hidden" id="idCliente" name="idCliente" value="'.$idCliente.'">


            <button type="submit" class="btn-cadastrar" onClick="a">Cadastrar</button>
        </form>
        </div>
    </div>
    
    ';
    }else{
        $pdo = Conexao::conecta();

        $cep = $_POST['cep'];
        $numero = $_POST['numero'];
        $complemento = $_POST['complemento'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $idCliente = $_POST['idCliente'];
        
        $mensagemDeErro = '';

        try{
            $pdo->beginTransaction();

            $endereco = new EnderecoModel(null, $cep, $rua, $numero, $bairro, $cidade, $estado);
            $id_endereco =  $endereco->inserirEndereco()->getId();

            $clienteEndereco = new ClienteEnderecoModel($idCliente, $id_endereco);
            $id_cliente_endereco =  $clienteEndereco->inserirClienteEndereco();
            
            $pdo->commit();
            $enderecoCadastrado = 1;
            
        }catch(PDOException $e){
            $pdo->rollBack();
            $enderecoCadastrado = 2;
            $mensagemDeErro = "Erro: ".$e->getMessage();
        }catch(RuntimeException $e){
            $pdo->rollBack();
            $enderecoCadastrado = 2;
            $mensagemDeErro = "Erro: ".$e->getMessage();
        }catch (Exception $e){
            $pdo->rollBack();
            $enderecoCadastrado = 2;
            $mensagemDeErro = "Erro: ".$e->getMessage();  
        }
    }
   
    if($enderecoCadastrado == 1){
        echo'
        <dialog>
            <h1>Dados Salvos com sucesso</h1>
            <a href="../paginaUsuario.php">
                <button>Sair</button>
            </a>
        </dialog>
    ';
    }else if ($enderecoCadastrado == 2){
        echo'<dialog>
            <h1>Algo deu Errado :( </h1>
            <h3>'.$mensagemDeErro.'</h3>
            <a href="../paginaUsuario.php">
                <button>Sair</button>
            </a>
                <button onClick="window.history.back()">Voltar</button>
        </dialog>';
}

    ?>
    <script src="../javascript/scriptModal.js"></script>
    <script src="../javascript/viaCEP.js" defer></script>
    <script src="../javascript/scriptCad.js" defer></script>
</main>
<?php require_once '../footer.php';?>
</body>
</html>