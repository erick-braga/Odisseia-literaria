<?php
include 'conecxao.php';

$arquivoJson = 'livros.json'; 

header('Content-Type: application/json');
header('Content-Disposition: attachment; filename="' . $arquivoJson . '"');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $user, $senha);
} catch (PDOException $e) {
    exit("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

$sql = "SELECT ID, TITULO, EDITORA, AUTOR, IDIOMA, GENERO, IMAGEM, FORMATO, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO FROM LIVRARIA";
$stmt = $pdo->query($sql);

$dados = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $dados[] = $row;  
}

echo json_encode($dados, JSON_PRETTY_PRINT);
?>
