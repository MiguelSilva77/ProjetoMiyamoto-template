<?php
require_once __DIR__.'/../conection/conexao.php';
/*
criado por Miguel Silva, class fincionarioModel, responsável por fazer as operações no bando de dados 
referente a tabela funcionarios

*/
class funcionarioModel{
    private $id_funcionario;
    private $nome;
    private $email;
    private $senha;
    private $dataCadastro;
    private $ultimaModificacao;

    public function __construct($id_funcionario = null, $nome = null, $email = null, $senha = null, $dataCadastro = null, $ultimaModificacao = null){
        $this->id_funcionario = $id_funcionario;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->dataCadastro = $dataCadastro;
        $this->ultimaModificacao = $ultimaModificacao;

    }

    public function getId(){
        return $this->id_funcionario;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getDataCadastro(){
        return $this->dataCadastro;
    }

    public function getUltimaModificacao(){
        return $this->ultimaModificacao;
    }

    public function setId($id){
        $this->id_funcionario = $id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setDataCadastro($dataCadastro){
        $this->dataCadastro = $dataCadastro;
    }

    public function setUltimaModificacao($ultimaModificacao){
        $this->ultimaModificacao = $ultimaModificacao;
    }
   

    public function inserirFuncionário(){
        $pdo = Conexao::conecta();
        $sql = "INSERT INTO FUNCIONARIOTESTE (id_funcionario, nome, email, senha, dataCadastro, ultimaModificacao)
            VALUES (null,?,?,?,null,null)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $this->nome,
            $this->email,
            $this->senha,
        ]);
    }

    public static function logaFuncionario($email, $senha){
        $pdo = Conexao::conecta();
        $sql = "SELECT * FROM FUNCIONARIOTESTE WHERE email = '$email' AND senha = '$senha'";
        $stmt = $pdo->query($sql);
        $quantidade = $stmt->rowCount();
        if($quantidade == 1){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return'dados incorretos';
        }
    }

    public static function verTodosOsFuncionários(){
        $pdo = Conexao::conecta();
        $funcionarios = [];

        $sql = "SELECT * FROM FUNCIONARIOTESTE";
        $stmt = $pdo->query($sql);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $funcionario = new funcionarioModel();

            $funcionario->setId($row['id_funcionario']);
            $funcionario->setNome($row['nome']);
            $funcionario->setEmail($row['email']);
            $funcionario->setDataCadastro($row['dataCadastro']);
            $funcionario->setUltimaModificacao($row['ultimaModificacao']);

            $funcionarios[] = $funcionario;
        }
        return $funcionarios;
    }

    public static function deletaFuncionario($id){
        $pdo = Conexao::conecta();
        $sql = "DELETE FROM FUNCIONARIOTESTE WHERE id_funcionario = '$id'";
        $stmt = $pdo->query($sql);
    }
}


?>