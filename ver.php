<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Livros | Odisseia Literária</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <style>
        @charset "utf-8";

        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

        :root {
            --font: "Josefin Sans", sans-serif;
            --primary-color: #E9B954;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 96vw;
            min-height: 100vh;
            font-family: var(--font);
            background-color: var(--primary-color);
            padding-bottom: 50px;
        }

        table {
            width: 1400px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6e6e6;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: white;
            padding: 20px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        nav > a {
            color: black;
            text-decoration: none;
            margin: 0 20px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        nav > a:hover {
            color: var(--primary-color);
        }

        legend {
            background-color: #333;
            color: white;
            padding: 15px;
            width: 1400px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }

        #table-container {
            width: fit-content;
            margin: 40px auto 0 auto;
        }

        form {
            width: fit-content;
            margin: 30px auto;
            text-align: center;
        }

        input[type="text"] {
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 400px;
            font-family: var(--font);
        }

        input[type="submit"] {
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #333;
            color: white;
            margin-left: 10px;
            cursor: pointer;
            font-family: var(--font);
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .book-cover {
            width: 80px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .action-link {
            color: #333;
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 3px;
            transition: all 0.3s;
        }

        .action-link:hover {
            background-color: #333;
            color: white;
        }

        .delete-link {
            color: #d9534f;
        }

        .delete-link:hover {
            background-color: #d9534f;
            color: white;
        }
    </style>
</head>

<body>
    <nav>
        <a href="cadastro.html">Cadastrar Livro</a>
        <a href="ver.php">Consultar Acervo</a>
    </nav>

    <form method="get" action="">
        <input type="text" name="pesquisa" placeholder="Pesquisar por título, autor, editora..." 
               value="<?php echo isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : ''; ?>">
        <input type="submit" value="Buscar">
    </form>

    <?php
    include 'conexao.php';

    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    if (isset($_GET['pesquisa']) && !empty(trim($_GET['pesquisa']))) {
        $pesquisa = "%" . trim($_GET['pesquisa']) . "%";
        $sql = "SELECT * FROM LIVRARIA WHERE 
                TITULO LIKE ? OR
                EDITORA LIKE ? OR
                AUTOR LIKE ? OR
                GENERO LIKE ? OR
                FORMATO LIKE ?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssss", $pesquisa, $pesquisa, $pesquisa, $pesquisa, $pesquisa);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT * FROM LIVRARIA ORDER BY TITULO ASC";
        $result = $conexao->query($sql);
    }
    if ($result->num_rows > 0) {
        echo '
        <div id="table-container">
            <table>
                <legend>Acervo Literário</legend>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Editora</th>
                    <th>Autor</th>
                    <th>Gênero</th>
                    <th>Formato</th>
                    <th>Capa</th>
                    <th>Valor (R$)</th>
                    <th>Ano</th>
                    <th>Estado</th>
                    <th>Ações</th>
                </tr>';

        while ($livro = $result->fetch_assoc()) {
            echo '
                <tr>
                    <td>' . htmlspecialchars($livro['ID']) . '</td>
                    <td>' . htmlspecialchars($livro['TITULO']) . '</td>
                    <td>' . htmlspecialchars($livro['EDITORA']) . '</td>
                    <td>' . htmlspecialchars($livro['AUTOR']) . '</td>
                    <td>' . htmlspecialchars($livro['GENERO']) . '</td>
                    <td>' . htmlspecialchars($livro['FORMATO']) . '</td>
                    <td><img src="images/' . htmlspecialchars($livro['IMAGEM']) . '" alt="Capa do livro" class="book-cover"></td>
                    <td>' . number_format($livro['VALOR_COMPRA'], 2, ',', '.') . '</td>
                    <td>' . htmlspecialchars($livro['ANO_PUBLICACAO']) . '</td>
                    <td>' . htmlspecialchars($livro['ESTADO']) . '</td>
                    <td>
                        <a href="editar.php?id=' . $livro['ID'] . '" class="action-link">Editar</a>
                        <a href="delete.php?id=' . $livro['ID'] . '" class="action-link delete-link">Excluir</a>
                    </td>
                </tr>';
        }

        echo '
            </table>
        </div>';
    } else {
        echo '<p style="text-align: center; margin-top: 30px; font-size: 1.2rem;">Nenhum livro encontrado no acervo.</p>';
    }
    if (isset($stmt)) {
        $stmt->close();
    }
    $conexao->close();
    ?>
</body>

</html>
