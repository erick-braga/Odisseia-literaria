
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conecxao.php"); 

$titulo = $_POST['TITULO'] ?? ''; //o ?? verifica se é null, se é nulo e pode ser nulo resebe o valor resebido, se é null e não pode ser4 recebe padrão
$editora = $_POST['EDITORA'] ?? '';
$autor = $_POST['AUTOR'] ?? '';
$idioma = $_POST['IDIOMA'] ?? '';
$genero = $_POST['GENERO'] ?? '';
$formato = $_POST['FORMATO'] ?? '';
$valor_compra = $_POST['VALOR_COMPRA'] ?? 0;
$ano_publicacao = $_POST['ANO_PUBLICACAO'] ?? '';
$estado = $_POST['ESTADO'] ?? '';

$diretorio = "images/";
$nomeFinal = 'sem-imagem.jpg';
if (isset($_FILES['IMAGEM']) && $_FILES['IMAGEM']['error'] === UPLOAD_ERR_OK) {
    $permitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['IMAGEM']['type'], $permitidos)) {
        die("Tipo de arquivo não permitido. Apenas imagens JPEG, PNG ou GIF são aceitas.");
    }

    $extensao = pathinfo($_FILES['IMAGEM']['name'], PATHINFO_EXTENSION);
    $nomeFinal = uniqid() . '.' . $extensao;
    $caminhoFinal = $diretorio . $nomeFinal;

    if (!move_uploaded_file($_FILES['IMAGEM']['tmp_name'], $caminhoFinal)) {
        die("Erro ao mover o arquivo de imagem para o diretório de destino.");
    }
} elseif (isset($_FILES['IMAGEM'])) {
    $erro = $_FILES['IMAGEM']['error'];
    $mensagensErro = [
        UPLOAD_ERR_INI_SIZE => 'O arquivo excede o tamanho máximo permitido.',
        UPLOAD_ERR_FORM_SIZE => 'O arquivo excede o tamanho máximo permitido pelo formulário.',
        UPLOAD_ERR_PARTIAL => 'O upload do arquivo foi feito parcialmente.',
        UPLOAD_ERR_NO_FILE => 'Nenhum arquivo foi enviado.',
        UPLOAD_ERR_NO_TMP_DIR => 'Pasta temporária ausente.',
        UPLOAD_ERR_CANT_WRITE => 'Falha ao escrever o arquivo no disco.',
        UPLOAD_ERR_EXTENSION => 'Uma extensão do PHP interrompeu o upload.'
    ];

    die("Erro no envio da imagem: " . ($mensagensErro[$erro] ?? "Erro desconhecido (Código: $erro)"));
}

$sql = "INSERT INTO LIVRARIA (TITULO, EDITORA, AUTOR, IMAGEM, IDIOMA, GENERO, FORMATO, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conexao->prepare($sql);
$stmt->bind_param(
    "sssssssdss",
    $titulo,
    $editora,
    $autor,
    $nomeFinal,
    $idioma,
    $genero,
    $formato,
    $valor_compra,
    $ano_publicacao,
    $estado
);

if ($stmt->execute()) {
    echo "<p>Livro cadastrado com sucesso!</p>";
    echo "<a href='cadastro.html'>Cadastrar novo livro</a>";
} else {
    echo "Erro ao inserir no banco: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>
