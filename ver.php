<?php
error_reporting(E_ALL);//se de erros imprime na tela
ini_set('display_errors', 1);

if (!file_exists('conecxao.php')) {
    die("Arquivo de conexão não encontrado!");
}

include 'conecxao.php';

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $stmt = $conexao->prepare("DELETE FROM LIVRARIA WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    
    header("Location: ver.php"); //recarega a pagina
    exit;
}

$sql = "SELECT ID, TITULO, AUTOR, EDITORA, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO, IMAGEM FROM LIVRARIA";
$resultado = $conexao->query($sql);

if (!$resultado) {
    die("Erro na consulta: " . $conexao->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Acervo Literário</title>
</head>
<body>
    <h1>Acervo Literário</h1>
    <a href="cadastro.html">Cadastrar Novo Livro</a>

    <?php if ($resultado->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Capa</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Editora</th>
                <th>Valor</th>
                <th>Ano</th>
                <th>Estado</th>
            </tr>
            <?php while ($livro = $resultado->fetch_assoc()): ?>  //percorre todas as linhas da tabela, qunaod não tiver mais nem uma retornaz null
            <tr>
              <td><?= $livro['ID'] ?></td>
  <td><?php if(!empty($livro['IMAGEM'])): ?>
                    <img src="images/<?= $livro['IMAGEM'] ?>" width="100">
                    <?php else: ?>
                    Sem imagem
                    <?php endif; ?>
        
                </td>
                <td><?= htmlspecialchars($livro['TITULO'] ?? '') ?></td>
                <td><?= htmlspecialchars($livro['AUTOR'] ?? '') ?></td>
                <td><?= htmlspecialchars($livro['EDITORA'] ?? '') ?></td>
                <td>R$ <?= number_format($livro['VALOR_COMPRA'], 2, ',', '.') ?></td>
                <td><?= $livro['ANO_PUBLICACAO'] ?></td>
                <td><?= $livro['ESTADO'] ?></td>
            </tr>
            <td>
        <form method="get" action="" style="display:inline;"> //botão para excluir 
            <input type="hidden" name="excluir" value="<?= $livro['ID'] ?>">
            <button type="submit" class="btn-excluir" 
                    onclick="return confirm('Tem certeza que deseja excluir este livro?')">
                Excluir
            </button>
        </form>
    </td>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Nenhum livro cadastrado no acervo.</p>
    <?php endif; ?>

    <?php $conexao->close(); ?>
</body>
</html>
                           



