<?php 
require_once __DIR__.'/../conection/conexao.php';
require_once  __DIR__.'/../models/produtoModel.php';

$id = $_POST['id'];

ProdutoModel::deletaProduto($id);
header("Location: ../config.php");
exit;