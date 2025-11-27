<?php
session_start();

// Se não estiver logado, manda de volta para o login
if (!isset($_SESSION['cpf'])) {
    header("Location: index.html");
    exit;
}

$cpf = $_SESSION['cpf'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <title> Cadastre a sua conta | Página Inicial </title>
    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/mobile.css" media="screen and (max-width: 600px)">
    <link rel="stylesheet" href="estilos/laptop.css" media="screen and (max-width: 1500px)">
    <link rel="stylesheet" href="estilos/laptop-1.css" media="screen and (max-width: 950px)">
    <link rel="stylesheet" href="estilos/tablet.css" media="screen and (max-width: 699px)">
    <link rel="stylesheet" href="estilos/style002.css">
    <link rel="stylesheet" href="estilos/mobile2.css" media="screen and (max-width: 500px)">



    <style>
        .nav {
            grid-area: nav;

            display: grid;
            justify-content: space-between;
            grid-auto-flow: column;
            gap: 1em;
            align-items: center;
            height: 90px;

        }

        .nav__list {
            list-style: none;
            display: grid;
            grid-auto-flow: column;
            gap: 1em;
        }

        .nav__link {
            color: #fff;
            text-decoration: none;
        }

        .nav__logo {
            margin-top: 10px;
            width: 200px;
            font-weight: 300;
        }

        .nav__menu {
            display: none;
        }

        .nav__icon {
            width: 30px;
        }

        /* --- */

        #form {
            padding: 30px;
        }

        @media (max-width:800px) {
            .nav__list {
                display: none;
            }

            .nav__menu {
                display: block;
            }

            .hero__main {
                grid-template-columns: 1fr;
                grid-template-rows: max-content max-content;
                text-align: center;
            }

            .hero__picture {
                grid-row: 1/2;
            }

            .hero__img {
                max-width: 500px;
                display: block;
                margin: 0 auto;
            }

            .modal__container {
                padding: 2em 1.5em;
            }

            .modal__title {
                font-size: 2rem;
            }
        }

        /* ------ */


        button {
            background-color: var(--roxo-profundo);
            width: 100%;
            padding: 20px;
            color: white;
            border: 0;
            font-weight: bolder;
            border-radius: 20px;
        }

        .icontainer {
            display: flex;
            justify-content: center;
        }

        #form a {
            color: #1d0031;
        }



        #form {

            min-height: 200px;

        }

        #form a {
            color: #1d0031;
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 10px;

        }

        label {
            display: block;
            margin-bottom: -15px;
        }

        input {
            border: 1px solid black;
            margin-top: -40px;
            border-radius: 5px;
        }

        #container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div id="nav-her">
        <nav class="nav container">
            <a href="index.html" style="border: 0;"><img src="img/Logo.png" class="nav__logo" alt=""></a>
            <ul class="nav__list">
                <li class="nav__item"><a href="index.html" class="nav__link">Inicio</a></li>
                <li class="nav__item"><a href="cadastro.php" class="nav__link">Cadastrar</a></li>
                <li class="nav__item"><a href="ver.php" class="nav__link">Livros</a></li>
                <li class="nav__item"><a href="logim.php" class="nav__link">Login</a></li>

            </ul>
            <figure class="nav__menu">
                <img src="img/menu.svg" class="nav__icon">
            </figure>
        </nav>
    </div>

    <main style="text-align: center; display: block;  margin-top: 100px;">
        <div>
            <h1>Bem-vindo, <?php echo htmlspecialchars($cpf); ?>! </h1>
            <p style="display: inline;">Você está logado no sistema.</p><br>
            <a href="cadastro.php">Cadastrar livro no acervo digital</a>
            <br>
            <br>
            <hr style="width: 400px; height: 1px; background-color: white; margin: auto;">
            <a href="listar.php" style="background-color: #8857a8ff; width:500px; color">Listar outros clientes
                cadastrados</a>
        </div>
    </main>

</body>

</html>