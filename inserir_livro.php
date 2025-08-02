<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conecxao.php");

$titulo = $_POST['TITULO'];
$editora = $_POST['EDITORA'];
$autor = $_POST['AUTOR'];
$idioma = $_POST['IDIOMA'];
$genero = $_POST['GENERO']; // Corrigido
$formato = $_POST['FORMATO'];
$valor_compra = $_POST['VALOR_COMPRA'];
$ano_publicacao = $_POST['ANO_PUBLICACAO'];
$estado = $_POST['ESTADO'];

$diretorio = "images/";

if (isset($_FILES['IMAGEM']) && $_FILES['IMAGEM']['error'] === UPLOAD_ERR_OK) {
    $nomeTemporario = $_FILES['IMAGEM']['tmp_name'];
    $nomeFinal = basename($_FILES['IMAGEM']['name']);
    $caminhoFinal = $diretorio . $nomeFinal;

    if (move_uploaded_file($nomeTemporario, $caminhoFinal)) {
        $sql = "INSERT INTO LIVRARIA (TITULO, EDITORA, AUTOR, IMAGEM, IDIOMA, GENERO, FORMATO, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO)
                VALUES ('$titulo', '$editora', '$autor', '$nomeFinal', '$idioma', '$genero', '$formato', $valor_compra, $ano_publicacao, '$estado');";

        if ($conexao->query($sql) === TRUE) {
            echo "<p>Livro cadastrado com sucesso!</p>";
            echo "<a href='cadastro.html'>Cadastrar novo livro</a>";
        } else {
            echo "Erro ao inserir no banco: " . $conexao->error;
        }
    } else {
        echo "Erro ao mover o arquivo de imagem.";
    }
} else {
    echo "Erro no envio da imagem. Código do erro: " . $_FILES['IMAGEM']['error'];
}
?>
