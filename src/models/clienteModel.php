<?php
/*
criado por Miguel Silva, class ClienteModel, responsável por fazer as operações no bando de dados 
referente a tabela clientes

*/
require_once '../conection/conexao.php';
require_once '../models/enderecoModel.php';

    class ClienteModel{
        
        private $id_cliente;
        private $nome;
        private $email;
        private $telefone;
        private $cpf;
        private $senha;
        private $enderecos = [];

        public function __construct($nome = null, $email = null, $telefone = null, $cpf = null, $senha = null){
            $this->nome = $nome;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->cpf = $cpf;
            $this->senha = $senha;
            
        }
    
    public function getId(){ 
        return $this->id_cliente; 
    }
    public function getNome(){
         return $this->nome; 
    }
    public function getEmail(){
         return $this->email; 
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function getCpf(){
        return $this->cpf;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function getEnderecos(){
        return $this->enderecos;
    }

    public function setId($id_cliente){
        $this->id_cliente = $id_cliente;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    public function setCpf($cpf){
        $this->cpf = $cpf;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function addEndereco($endereco){
        $enderecos[] = $endereco;
    }

    


        public function inserirCliente(){
            $pdo = Conexao::conecta();

            //mudar essa linha depois, apenas carater de teste de conexão
            $sql = "INSERT INTO CLIENTETESTE (id_cliente ,nome, email, telefone, cpf, senha) 
                    VALUES (null,?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                            $this->nome,
                            $this->email,
                            $this->telefone,
                            $this->cpf,
                            $this->senha,
                            ]);     

            $this->id_cliente = $pdo->lastInsertId();
            return $this;
            }

            public static function verTodosOsClientes(){
                $pdo = Conexao::conecta();
                $clientes = [];

                $sql = "SELECT * FROM CLIENTETESTE";
                $stmt = $pdo->query($sql);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $cliente = new ClienteModel();

                    $cliente->setId($row['id_cliente']);
                    $cliente->setNome($row['nome']);
                    $cliente->setEmail($row['email']);
                    $cliente->setTelefone($row['telefone']);
                    $cliente->setCpf($row['cpf']);
                    $cliente->setSenha($row['senha']);
                       
                    $clientes[] = $cliente;
                };
                return $clientes;
                //return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, self::class);
            }

            public function __toString(){
            return "ID: {$this->id_cliente}, Nome: {$this->nome}, Email: {$this->email}, Telefone: {$this->telefone}, CPF: {$this->cpf}";
}

            

    }

?>