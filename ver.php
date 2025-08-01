<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso! | bestcarros</title>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <style>
        @charset "utf-8";

        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&display=swap');

        :root {
            --font: "Josefin Sans", sans-serif;
            --desaturated-red: #E9B954;
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
            background-color: var(--desaturated-red);
        }

        table {
            width: 1400px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: white;
            color: black;
        }

        tr:nth-child(even) {
            background-color: rgb(124, 124, 124);
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: white;
            padding: 20px;
            width: 100vw;
        }

        nav > a {
            color: black;
            text-decoration: none;
            margin-right: 40px;
        }

        legend {
            background-color: #333;
            color: white;
            margin-bottom: -20px;
            padding: 20px;
            width: 1400px;
            text-align: center;
        }

        #table {
            width: fit-content;
            margin: 40px auto 0 auto;
        }

        form {
            width: fit-content;
            margin: 20px auto;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 300px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            background-color: #333;
            color: white;
            margin-left: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <nav>
        <a href="cadastro.html">Cadastro</a>
        <a href="ver.php">Verificação</a>
    </nav>

    <form method="get" action="">
        <input type="text" name="pesquisa" placeholder="Pesquisar livro" value="<?php echo isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : ''; ?>">
        <input type="submit" value="Buscar">
    </form>

    <?php
    include 'conexao.php';

    if (isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {
        $pesquisa = $conexao->real_escape_string($_GET['pesquisa']);
        $sql = "SELECT * FROM LIVRARIA WHERE 
                    ID LIKE '%$pesquisa%' OR
                    TITULO LIKE '%$pesquisa%' OR
                    EDITORA LIKE '%$pesquisa%' OR
                    IDIOMA LIKE '%$pesquisa' OR
                    GENERO LIKE '%$pesquisa' OR
                    AUTOR LIKE '%$pesquisa%' OR
                    IMAGEM LIKE '%$pesquisa%' OR
                    FORMATO LIKE '%$pesquisa%' OR
                    VALOR_COMPRA LIKE '%$pesquisa%' OR
                    ANO_PUPLICACAO LIKE '%$pesquisa%'OR
                    ESTADO LIKE '%$pesquisa%'";
    } else {
        $sql = "SELECT * FROM ulos";
    }

    $ver = $conexao->query($sql);

    echo "
    <div id='table'>
    <table>
    <legend>Tabela de veículos</legend>
    <tr>
        <th>ID</th>
        <th>TITULLO</th>
        <th>EDITORA</th>
        <th>AUTOR</th>
        <th>IDIOMA</th>
        <th>GENERO</th>
        <th>IMAGEM</th>
        <th>FORMATO</th>
        <th>VALOR DA COMPRA</th>
        <th>ANO DA PUBLICAÇÃO</th>
        <th>ESTADO</th>
    </tr>
    ";

    while ($livros = $ver->fetch_assoc()) {
        echo "
        <tr>
            <td>{$livros['id']}</td>
            <td>{$livros['TITULO']}</td>
            <td>{$livros['EDITORA']}</td>
            <td>{$livros['AUTOR']}</td>
            <td>{$livros['IDIOMA']}</td>
            <td>{$livros['GENERO']}</td>
            <td><img src='images/{$livros['IMAGEM']}' alt='Capa' width='100'></td>
            <td>{$livros['FORMATOS']}</td>
            <td>{$livros['VALOR DA COMPRAR']}</td>
            <td>{$livros['ANO DA PUBLICAÇÂO']}</td>
            <td>{$livros['ESTADO']}</td>
            <td>
                <a href='delete.php?id={$livros['id']}'>Excluir</a>
            </td>
        </tr>
        ";
    }

    echo "</table></div>";
    ?>
</body>

</html>
