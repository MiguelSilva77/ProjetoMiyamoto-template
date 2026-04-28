<?php 
require_once __DIR__.'/../conection/conexao.php';
require_once  __DIR__.'/../models/funcionarioModel.php';

$id = $_POST['id'];

funcionarioModel::deletaFuncionario($id);
header("Location: ../config.php");
exit;