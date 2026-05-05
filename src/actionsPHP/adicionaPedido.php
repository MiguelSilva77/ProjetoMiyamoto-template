<?php
session_start();
require_once '../conection/conexao.php';
require_once '../models/produtoModel.php';
require_once '../models/enderecoModel.php';
require_once '../models/clienteModel.php';
require_once '../models/itemModel.php';
require_once '../models/pedidoModel.php';


$endereco = $_POST['enderecoEscolha'];
$cliente = $_POST['cliente'];

echo "cliente: $cliente endereco: $endereco";

?>