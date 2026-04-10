<?php  
/*
criado por Miguel Silva, class EnderecoModel, responsável por fazer as operações no bando de dados 
referente a tabela Endereco

*/
require_once __DIR__.'/../conection/conexao.php';
require_once __DIR__.'/../models/clienteModel.php';


class EnderecoModel{

    private $id_endereco;
    private $cep;
    private $rua;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    private $complemento;

    public function __construct($id_endereco = null,$cep = null, $rua = null, $numero = null, $bairro = null, $cidade = null, $estado = null, $complemento = null){
        $this->id_endereco = $id_endereco;
        $this->cep = $cep;
        $this->rua = $rua;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->complemento = $complemento;
        
    }

    public function getId(){
        return $this->id_endereco;
    }

    public function getCep(){
        return $this->cep;
    }

    public function getRua(){
        return $this->rua;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getComplemento(){
        return $this->complemento;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setId($id_endereco){
        $this->id_endereco = $id_endereco;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }

    public function setRua($rua){
        $this->rua = $rua;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function setComplemento($complemento){
        $this->complemento = $complemento;
    }

    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
    public function setCidade($cidade){
        $this->cidade = $cidade;
    }
    public function setEstado($estado){
        $this->estado = $estado;
    }


    public function inserirEndereco(){
        $pdo = Conexao::conecta();

        //mudar essa linha depois, apenas carater de teste de conexão
        $sql = "INSERT INTO ENDERECOTESTE (cep, rua, numero, complemento, bairro, cidade, estado) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$this->cep,
                        $this->rua,
                        $this->numero,
                        $this->complemento,
                        $this->bairro,
                        $this->cidade,
                        $this->estado
                        ]);
        $this->id_endereco = $pdo->lastInsertId();
        return $this;
    }

    public static function buscarTodosOsEnderecos(){
        $pdo = Conexao::conecta();
        $enderecos = [];

        $sql = "SELECT * FROM ENDERECOTESTE";
        $stmt = $pdo->query($sql);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $endereco = new EnderecoModel();

            $endereco->setId($row['id_endereco']);
            $endereco->setRua($row['rua']);
            $endereco->setNumero($row['numero']);
            $endereco->setComplemento($row['complemento']);
            $endereco->setBairro($row['bairro']);
            $endereco->setCidade($row['cidade']);
            $endereco->setEstado($row['estado']);

            $enderecos[] = $endereco;
        }
        return $enderecos;
    }

    public function procurarEnderecoPorId($id){
         $pdo = Conexao::conecta();
         $sql = "SELECT * FROM ENDERECOTESTE WHERE id_endereco = $id";
         $stmt = $pdo->query($sql);
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $endereco = new EnderecoModel();

            $endereco->setId($row['id_endereco']);
            $endereco->setCep($row['cep']);
            $endereco->setRua($row['rua']);
            $endereco->setNumero($row['numero']);
            $endereco->setBairro($row['bairro']);
            $endereco->setCidade($row['cidade']);
            $endereco->setEstado($row['estado']);
            $endereco->setComplemento($row['complemento']);

            $enderecos = $endereco;
            return $enderecos;
         }
    }

    public function __toString(){
        return "ID: {$this->id_endereco}, 
                CEP: {$this->cep}, 
                Rua: {$this->rua}, 
                Numero: {$this->numero}, 
                Complemento: {$this->complemento}, 
                Bairro: {$this->bairro}, 
                Cidade: {$this->cidade}, 
                Estado: {$this->estado} ";
    }

}

?>