<?php
session_start();

if($_SESSION['id_cliente']==null){
    header("Location: login.php");
}

$nome = $_SESSION['nome'];

echo "$nome";

echo"essa página é dedicada ao cliente, aqui o cliente poderá ver seus endereços, adicionar um novo endereço, modificar endereço, ver seus pedidos, adicionar avaliação aos pedidos já feitos ";