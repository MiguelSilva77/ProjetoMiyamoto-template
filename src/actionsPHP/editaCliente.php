<?php
    require_once '../models/clienteEnderecoModel.php';
    require_once '../models/clienteModel.php';
    require_once '../models/enderecoModel.php';
    require_once '../conection/conexao.php';

    
    $pdo = Conexao::conecta();
    $nomeAlterado = $_POST['nome'];

    if($nomeAlterado == null){
        $dados = $_POST['dados'];
        echo $_POST['dados'];
        $cliente = ClienteModel::verClientePorId($dados);

        echo '
        <form action="" method="POST">
            <input type="text" name="id" id="id" value="'.$cliente->getId().'" >
            <input type="text" name="senha" id="senha" value="'.$cliente->getSenha().'" >


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
       
        }catch (RuntimeException $e){
            echo$e->getMessage();
            $pdo->rollBack();
        }

    }

    
   
        

       

   
    
    
?>


<h1>olá</h1>


