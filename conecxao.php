<?php
$host = "localhost:3306";
$user = "root";
$senha = "";
$banco = "loja";

$conexao = new mysqli($host,$user,$senha,$banco);

if ($conexao->connect_error){
	die("erro: " . $conexao->connect_error);
}
?>
