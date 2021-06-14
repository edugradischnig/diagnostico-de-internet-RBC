<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dataBaseName = "suporte";

$connection = mysqli_connect($serverName, $userName, $password, $dataBaseName);

if(!$connection){
    die("Erro ao conectar com o banco de dados: ". mysqli_connect_error());
}
?>