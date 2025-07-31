<?php
include("conecxao.php");

$titulo = $_POST['TITULO'];
$editora = $_POST['EDITORA'];
$autor = $_POST['AUTOR'];
$imagem = $_POST['IMAGEM'];
$idioma = $_POST['IDIOMA'];
$GENERO = $_POST['GENERO'];
$formato = $_POST['FORMATO'];
$valor_compra = $_POST['VALOR_COMPRA'];
$ano_publicacao = $_POST['ANO_PUBLICACAO'];
$estado = $_POST['ESTADO'];

$sql = "INSERT INTO LIVRARIA(TITULO, EDITORA, AUTOR, IMAGEM, FORMATO, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO)
        VALUES ('$titulo', '$editora', '$autor', '$imagem', '$formato', $valor_compra, $ano_publicacao, '$estado');";

if ($conexao->query($sql) === TRUE) {
    echo "<p>Livro cadastrado com sucesso!</p>";
    echo "<a href='cadastro.html'>Cadastrar novo livro</a>";
} else {
    echo "Erro: " . $conexao->error;
}

$conexao->close();
?>
