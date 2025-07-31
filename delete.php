<!DOCTYPE html>
<html lang="en">

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
            ;

            --desaturated-red: #E9B954;
            --soft-red: hsl(0, 93%, 68%);
            --dark-grayish-red: hsl(0, 6%, 24%);
        }

        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-color: var(--desaturated-red);
            color: white;
            font-family: var(--font);
            height: 100vh;
            margin: 0;

        }

        #cad {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 90vh;
        }

        p {
            font-weight: bolder;
        }

        #cad-a {
            margin-top: 20px;
            color: var(--desaturated-red);
            text-decoration: none;
            background-color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        #cad-a:hover {
            background-color: rgb(255, 214, 125);
            color: white;
        }

        nav {
            display: flex;
            justify-content: center;
            background-color: white;
            padding: 20px 0px;
        }

        nav>a {
            color: black;
            text-decoration: none;
            display: block;
            margin-right: 40px;
        }
    </style>
</head>

<body>
    <nav>
        <a href="cadastro.html">Cadastro</a>
        <a href="ver.php">Verificação</a>
    </nav>
</body>

</html>

<?php
include 'conexao.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM LIVRARIA WHERE id = $id";

    if ($conexao->query($sql) === TRUE) {
        echo "<div id='cad'><p>Excluído com sucesso!</p> <a href='ver.php' id='cad-a'>Voltar à lista</a></div>";
    } else {
        echo "erro " . $conexao->error;
    }
} else {
    echo "id não informado";
}
?>
