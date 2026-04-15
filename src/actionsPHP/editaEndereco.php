<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script> 
    <script src="../javascript/viaCEP.js" defer></script>
    <title>Document</title>
</head>
<body>
    <?php
    require_once '../models/clienteEnderecoModel.php';
    require_once '../models/clienteModel.php';
    require_once '../models/enderecoModel.php';
    require_once '../conection/conexao.php';

    $pdo = Conexao::conecta();

    $ruaAlterada = $_POST['rua'];
    $alteracaoRealizada = 0;
    $mensagemDeErro = '';

    if($ruaAlterada == null){
        $dados = $_POST['dados'];
        $endereco = EnderecoModel::procurarEnderecoPorId($dados);

        echo'<h1>Altere os dados que deseja atualizar</h1>
        <form action="" method="post">
            <input style="display: none;" type="text" name="id" id="id" value="'.$endereco->getId().'" >
            <label for="cep">CEP:</label>
                <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank" class="nCEP">
                     Não sei meu cep
                </a>
            <input type="text" id="cep" name="cep" maxlength="9" value="'.$endereco->getCep().'" required>
        
            <label for="rua">Rua:</label>
            <input type="text" id="rua" name="rua" value="'.$endereco->getRua().'" required>

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" value="'.$endereco->getNumero().'"required>

            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" value="'.$endereco->getComplemento().'">

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro" value="'.$endereco->getBairro().'" required>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="'.$endereco->getCidade().'" required>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado" value="'.$endereco->getEstado().'" required>

            <button type="submit" class="btn-cadastrar">Cadastrar</button>
        </form>';
    }else{
        $id = $_POST['id'];
        $cepAlterado = $_POST['cep'];
        $numeroAlterado = $_POST['numero'];
        $complementoAlterado = $_POST['complemento'];
        $bairroAlterado = $_POST['bairro'];
        $cidadeAlterada = $_POST['cidade'];
        $estadoAlterado = $_POST['estado'];

        $enderecoAlterado = new EnderecoModel($id, $cepAlterado, $ruaAlterada, $numeroAlterado, $bairroAlterado, $cidadeAlterada, $estadoAlterado, $complementoAlterado);

       try{  
        $pdo->beginTransaction();

        $idEnderecoAlterado = $enderecoAlterado->editaEndereco($enderecoAlterado);
        echo $idEnderecoAlterado;

        $pdo->commit();
        $alteracaoRealizada = 1;
       }catch(RuntimeException $e){
        echo $e->getMessage();
        $pdo->rollBack();
       }catch(Exception $e){
        echo $e->getMessage();
        $pdo->rollBack();
       }
    }

    if($alteracaoRealizada == 1){
           echo'<dialog>
            <h1>Dados Atualizados com sucesso</h1>
            <a href="../paginaUsuario.php">
                <button>Sair</button>
            </a>
                
           
        </dialog>';
    }



?>

    
</body>
<style>dialog {
    border: none;
    border-radius: 15px;
    padding: 30px;
    width: 300px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

dialog::backdrop {
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(3px); 
}

dialog button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 15px;
}</style>


<Script>
    const mensagem = document.querySelector("dialog");
    mensagem.showModal();
</Script>
</html>

