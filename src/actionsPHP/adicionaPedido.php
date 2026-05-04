<?php
session_start();
require_once '../conection/conexao.php';
require_once '../models/produtoModel.php';
require_once '../models/enderecoModel.php';
require_once '../models/clienteModel.php';
require_once '../models/itemModel.php';
require_once '../models/pedidoModel.php';





if(!isset($_POST['cliente'])|| $_POST['cliente'] == null){
   echo "<script>alert('Login não realizado, entre com seu usuário e senha para continuar a operação'); window.location.href='../login.php';</script>";
exit;

}

$cliente = $_POST['cliente'];
$produto = $_POST['produto'];

echo "produto $produto cliente $cliente";

?>