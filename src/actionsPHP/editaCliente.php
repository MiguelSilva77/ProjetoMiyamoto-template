<?php
    require_once '../models/clienteEnderecoModel.php';
    require_once '../models/clienteModel.php';
    require_once '../models/enderecoModel.php';
    require_once '../conection/conexao.php';

    
    $pdo = Conexao::conecta();
    @$nomeAlterado = $_POST['nome'];
    $alteracaoRealizada = 0;
    $mensagemDeErro = ' ';

    if($nomeAlterado == null){
        $dados = $_POST['dados'];
        $cliente = ClienteModel::verClientePorId($dados);

        echo '<h1>Altere os dados que deseja atualizar</h1>
        <form action="" method="POST">
            <input style="display: none;" type="text" name="id" id="id" value="'.$cliente->getId().'" >
            <input style="display: none;" type="text" name="senha" id="senha" value="'.$cliente->getSenha().'" >


            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" value="'.$cliente->getNome().'" required>

          	<label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" value="'.$cliente->getEmail().'" required>

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" maxlength="14" placeholder="(99)99999-9999" value="'.$cliente->getTelefone().'" required>

            <label for="telefone">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="999.999.999-99" value="'.$cliente->getCpf().'" required>

            
            <button type="submit" class="btn-cadastrar">Atualizar</button>
        </form>';

    }else{
        $emailAlterado = $_POST['email'];
        $telefoneAlterado = $_POST['telefone'];
        $cpfAlterado = $_POST['cpf'];
        $id = $_POST['id'];
        $senha = $_POST['senha'];

        $clienteAlterado = new ClienteModel($id, $nomeAlterado, $emailAlterado, $telefoneAlterado, $cpfAlterado, $senha);

        try{
            $pdo->beginTransaction();

            $idClienteAlterado = $clienteAlterado->editarCliente($clienteAlterado);
            echo $idClienteAlterado;
       

            $pdo->commit();
            $alteracaoRealizada = 1;
       
        }catch (PDOException $e){
            if($e->errorInfo[1] == 1062){
                if(str_contains($e->getMessage(), 'email')){
                    echo "Este email já está cadastrado no nosso banco de dados, <a href='../login.php'> tente logar aqui</a>";
                    $alteracaoRealizada = 2;
                    $mensagemDeErro = "Este email já está cadastrado no nosso banco de dados";
                    $pdo->rollBack();
                }else if(str_contains($e->getMessage(),'cpf')){
                    $mensagemDeErro = "Este cpf já está cadastrado no nosso banco de dados, <a href='../login.php'> tente logar aqui</a>";
                    $pdo->rollBack();
                }else{
                    $mensagemDeErro = "Erro dados duplicados";
                    $pdo->rollBack();
                }
            }else{
                $mensagemDeErro = "erro inespérado: ".$e->getMessage();
                $pdo->rollBack();
            }
        }catch (RuntimeException $e){
            $mensagemDeErro = "Ocorreu um erro: ".$e->getMessage();
            $pdo->rollBack();
        }

    }

    
   if($alteracaoRealizada == 1){
    //alterar posteriormente, ao clicar em sair a página deve ser redirecioanada para página do cliente;
        echo'<dialog>
            <h1>Dados Atualizados com sucesso</h1>
            <a href="../index.php">
                <button>Sair</button>
            </a>
                
           
        </dialog>';
   }else if($alteracaoRealizada == 2){
        echo'<dialog>
            <h1>Algo deu Errado :( </h1>
            <h3>'.$mensagemDeErro.'</h3>
            <a href="../index.php">
                <button>Sair</button>
            </a>
                <button onClick="window.history.back()">Voltar</button>
        </dialog>';
   }
        

       

   
    
    
?>

<!-- colocar esse script e style em página separada depois -->
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