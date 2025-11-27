<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$host = "localhost";
$user = "root";
$senha = "";
$banco = "loja";

$conexao = new mysqli($host,$user,$senha,$banco);

if ($conexao->connect_error){
	die("erro: " . $conexao->connect_error);
}
?>
