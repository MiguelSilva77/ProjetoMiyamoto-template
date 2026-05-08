<?php
/*
criado por Miguel Silva, class ClienteModel, responsável por fazer as operações no bando de dados 
referente a tabela clientes

*/
require_once __DIR__.'/../conection/conexao.php';
require_once __DIR__.'/../models/enderecoModel.php';
require_once __DIR__.'/../models/pedidoModel.php';


    class ClienteModel{
        
        private $id_cliente;
        private $nome;
        private $email;
        private $telefone;
        private $cpf;
        private $senha;
        private $enderecos = [];

        public function __construct($id_cliente = null,$nome = null, $email = null, $telefone = null, $cpf = null, $senha = null){
            $this->id_cliente = $id_cliente;
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
            $sql = "INSERT INTO CLIENTE (id_cliente ,nome, email, telefone, cpf, senha) 
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

                $sql = "SELECT * FROM CLIENTE";
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
            }

            public static function verClientePorId($id){
                $pdo = Conexao::conecta();
                $sql = "SELECT * FROM CLIENTE WHERE id_cliente = $id";
                $stmt = $pdo->query($sql);
                 while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $cliente = new ClienteModel();

                    $cliente->setId($row['id_cliente']);
                    $cliente->setNome($row['nome']);
                    $cliente->setEmail($row['email']);
                    $cliente->setTelefone($row['telefone']);
                    $cliente->setCpf($row['cpf']);
                    $cliente->setSenha($row['senha']);
                       
                    $clientes = $cliente;
                };
                return $clientes;
            }

           

            public function editarCliente($cliente){
                $pdo = Conexao::conecta();

                 $sql = "UPDATE CLIENTE set
                        nome = :nome,
                        email = :email,
                        telefone = :telefone,
                        cpf = :cpf
                        WHERE id_cliente = :id";

                $stmt = $pdo->prepare($sql);

                $stmt->bindValue(':nome',$cliente->getNome());
                $stmt->bindValue(':email',$cliente->getEmail());
                $stmt->bindValue(':cpf',$cliente->getCpf());
                $stmt->bindValue(':telefone',$cliente->getTelefone());
                $stmt->bindValue(':id',$cliente->getId());

                $stmt->execute();

                return $cliente->id_cliente;
            }

            public static function logaCliente($email, $senha){
                $pdo = Conexao::conecta();
                $sql = "SELECT * FROM CLIENTE WHERE email = :email";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':email',$email);
                $stmt->execute();
                $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
                if($cliente){
                    if(password_verify($senha, $cliente['senha'])){
                return $cliente;
                    }

                }
                return false;
            }

            public static function clienteJSON($cliente){
                $clienteJSON = json_encode($cliente);
                return $clienteJSON;
            }

            public static function verPedidoPorCliente($id){
                $pdo = Conexao::conecta();
                $pedidos = [];
                $sql = "SELECT * FROM PEDIDO WHERE idCliente = $id ORDER BY idPedido DESC";
                $stmt = $pdo->query($sql);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                   $pedido = new PedidoModel();
                   
                   $pedido->setId($row['idPedido']);
                   $pedido->setCliente($row['idCliente']);
                   $pedido->setEndereco($row['idEndereco']);
                   $pedido->setDataPedido($row['dataPedido']);
                   
                   $pedidos[] = $pedido;
                }

                return $pedidos;
            }

            
            
             public function __toString(){
                return "ID: {$this->id_cliente}, Nome: {$this->nome}, Email: {$this->email}, Telefone: {$this->telefone}, CPF: {$this->cpf}";
            }

    }

    

?>