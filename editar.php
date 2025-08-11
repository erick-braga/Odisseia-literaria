<?php
include 'conecxao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $valor = floatval(str_replace(',', '.', $_POST['valor']));
    $ano = intval($_POST['ano']);
    $estado = $_POST['estado'];

    $stmt = $conexao->prepare("SELECT IMAGEM FROM LIVRARIA WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $livro_antigo = $resultado->fetch_assoc();
    $stmt->close();

    $imagem_nome = $livro_antigo['IMAGEM'];

    if (!empty($_FILES['nova_imagem']['name'])) {
        $extensao = pathinfo($_FILES['nova_imagem']['name'], PATHINFO_EXTENSION);
        $imagem_nome = uniqid() . "." . $extensao;


        move_uploaded_file($_FILES['nova_imagem']['tmp_name'], "images/" . $imagem_nome);

        if (!empty($livro_antigo['IMAGEM']) && file_exists("images/" . $livro_antigo['IMAGEM'])) {
            unlink("images/" . $livro_antigo['IMAGEM']);
        }
    }
    $stmt = $conexao->prepare("UPDATE LIVRARIA SET TITULO=?, AUTOR=?, EDITORA=?, VALOR_COMPRA=?, ANO_PUBLICACAO=?, ESTADO=?, IMAGEM=? WHERE ID=?");
    $stmt->bind_param("sssdissi", $titulo, $autor, $editora, $valor, $ano, $estado, $imagem_nome, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ver.php");
    exit;
}

if (!isset($_GET['id'])) {
    echo "ID não fornecido.";
    exit;
}

$id = intval($_GET['id']);
$stmt = $conexao->prepare("SELECT * FROM LIVRARIA WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Livro não encontrado.";
    exit;
}

$livro = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style002.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Editar Livro</title>

    <style>
        label {
            display: block;
            font-size: 1.1em
        }

        input {
            font-size: 1.3em;
        }

        #form {
            border-radius: 20px;
            width: 500px;
            height: 970px
        }

        .container {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;

        }

        #img-edit {
            font-size: 1.4em;
            text-align: center;
        }

        #img-edit>img {
            width: 200px;
        }

        button {
            cursor: pointer;
        }

        button:hover {
            background-color: rgba(200, 129, 247, 1);
        }
    </style>
</head>

<body>

    <cdiv class="container">
        <div id="form">
            <form method="post" action="editar.php" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $livro['ID'] ?>">
                <label>Título: <input type="text" name="titulo" value="<?= htmlspecialchars($livro['TITULO']) ?>"
                        required></label><br>
                <label>Autor: <input type="text" name="autor" value="<?= htmlspecialchars($livro['AUTOR']) ?>"
                        required></label><br>
                <label>Editora: <input type="text" name="editora" value="<?= htmlspecialchars($livro['EDITORA']) ?>"
                        required></label><br>
                <label>Valor: <input type="text" name="valor"
                        value="<?= number_format($livro['VALOR_COMPRA'], 2, ',', '') ?>" required></label><br>
                <label>Ano de Publicação: <input type="number" name="ano" value="<?= $livro['ANO_PUBLICACAO'] ?>"
                        required></label><br>
                <label>Estado: <input type="text" name="estado" value="<?= htmlspecialchars($livro['ESTADO']) ?>"
                        required></label><br>
                <div id="img-edit">
                    <p>Imagem atual:</p>
                    <?php if (!empty($livro['IMAGEM'])): ?>
                        <img src="images/<?= $livro['IMAGEM'] ?>" width="100"><br>
                    <?php else: ?>
                        <p>Sem imagem</p>
                    <?php endif; ?>
                </div>
                <label>Nova Imagem (opcional): <input type="file" name="nova_imagem"></label><br><br>
                <button type="submit" style="width: 100%;
                padding: 20px; border: 0px; border-radius: 10px;
                background-color: #1d0031; color: white;
                ">Salvar</button>
                <a href="ver.php">Cancelar</a>
            </form>
        </div>
    </cdiv>
</body>

</html>