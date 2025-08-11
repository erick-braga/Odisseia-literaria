<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Livros | Cadastre seu livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/style002.css">
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <style>
        body {
            background-image: linear-gradient(to top, var(--roxo-profundo)60%, #440072);
            height: 100vh;
        }

        header {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            justify-content: space-around;
            gap: 10px;
        }

        nav {
            padding: 0px 10px;
            flex-flow: row wrap;
            display: flex;
            gap: 10px;
        }

        nav>a {
            display: inline-block;
            flex: 0 1 68px;
            border: 1px solid;
            border-radius: 30px;

        }

        .hero {
            background-image: linear-gradient(to top, #1e3c72 0%, #1e3c72 1%, #2a5298 100%);
            color: #fff;
            display: grid;
            grid-template-rows: max-content 1fr;
            grid-template-areas:
                "nav"
                "content";
            min-height: 100vh;
        }

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

        #image {
            border: 10px solid white;

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
            </ul>
            <figure class="nav__menu">
                <img src="img/menu.svg" class="nav__icon">
            </figure>
        </nav>
    </div>

    <main>
        <div class="container">
            <div id="image">
                <div id="input-file">

                </div>
            </div>
            <div id="form">
                <h1>Cadastrar livro</h1>
                <form action="inserir_livro.php" method="POST" enctype="multipart/form-data">
                    <label for="titulo">Título:</label><br>
                    <input type="text" id="titulo" name="TITULO" required placeholder="Título"><br>

                    <label for="editora">Editora:</label><br>
                    <input type="text" id="editora" name="EDITORA" required placeholder="Editora"><br>

                    <label for="autor">Autor:</label><br>
                    <input type="text" id="autor" name="AUTOR" required placeholder="Autor"><br>

                    <label for="idioma">Idioma:</label><br>
                    <input type="text" id="idioma" name="IDIOMA" required placeholder="Idioma"><br>

                    <label for="genero">Gênero:</label><br>
                    <select id="genero" name="GENERO" required>
                        <option value="" disabled selected>Gênero</option>
                        <!-- suas opções seguem abaixo -->
                        <option value="Romance">Romance</option>
                        <option value="Conto">Conto</option>
                        <option value="Crônica">Crônica</option>
                        <option value="Poesia">Poesia</option>
                        <option value="Fábula">Fábula</option>
                        <option value="Drama">Drama</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Tragédia">Tragédia</option>
                        <option value="Auto">Auto</option>
                        <option value="Ensaios">Ensaios</option>
                        <option value="Literatura Infantil">Literatura Infantil</option>
                        <option value="Literatura Juvenil">Literatura Juvenil</option>
                        <option value="Biografia">Biografia</option>
                        <option value="Autobiografia">Autobiografia</option>
                        <option value="Memórias">Memórias</option>
                        <option value="Epistolar">Epistolar</option>
                        <option value="Fantasia">Fantasia</option>
                        <option value="Ficção Científica">Ficção Científica</option>
                        <option value="Terror">Terror</option>
                        <option value="Suspense">Suspense</option>
                        <option value="Mistério">Mistério</option>
                        <option value="Aventura">Aventura</option>
                        <option value="Histórico">Histórico</option>
                        <option value="Policial">Policial</option>
                        <option value="Psicológico">Psicológico</option>
                        <option value="Erótico">Erótico</option>
                        <option value="Didático">Didático</option>
                        <option value="Religioso">Religioso</option>
                        <option value="Espiritualista">Espiritualista</option>
                        <option value="Autoajuda">Autoajuda</option>
                        <option value="Humor">Humor</option>
                        <option value="Satírico">Satírico</option>
                        <option value="Lírico">Lírico</option>
                        <option value="Épico">Épico</option>
                        <option value="Narrativo">Narrativo</option>
                        <option value="Dramático">Dramático</option>
                        <option value="Gótico">Gótico</option>
                        <option value="Distopia">Distopia</option>
                        <option value="Utopia">Utopia</option>
                        <option value="Realismo Mágico">Realismo Mágico</option>
                        <option value="Regionalista">Regionalista</option>
                        <option value="Naturalismo">Naturalismo</option>
                        <option value="Romantismo">Romantismo</option>
                        <option value="Modernismo">Modernismo</option>
                        <option value="Pós-modernismo">Pós-modernismo</option>
                        <option value="Realismo">Realismo</option>
                        <option value="Simbolismo">Simbolismo</option>
                        <option value="Expressionismo">Expressionismo</option>
                        <option value="Existencialismo">Existencialismo</option>
                        <option value="Surrealismo">Surrealismo</option>
                    </select><br>



                    <label for="formato">Formato:</label><br>
                    <select id="formato" name="FORMATO" required>
                        <option value="" disabled selected>Formato</option>
                        <option value="FISICO">Físico</option>
                        <option value="DIGITAL">Digital</option>
                    </select><br>

                    <label for="valor">Valor de Compra:</label><br>
                    <input type="number" id="valor" name="VALOR_COMPRA" step="0.01" required placeholder="Valor"><br>

                    <label for="ano">Ano de Publicação:</label><br>
                    <input type="number" id="ano" name="ANO_PUBLICACAO" required placeholder="Ano" min-lenght="4"
                        max-lenght="4"><br>

                    <label for="imagem">Imagem:</label><br>
                    <input type="file" id="imagem" name="IMAGEM" accept="image/*" required><br>
                    <?php
                    // Verificar se o formulário foi enviado e se a imagem foi enviada
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['IMAGEM'])) {
                        $imagem = $_FILES['IMAGEM']['name'];  // Nome original do arquivo
                        $target_dir = "imagens/";  // Diretório onde a imagem será salva
                        $target_file = $target_dir . basename($imagem);  // Caminho completo do arquivo
                    
                        // Verificar se o arquivo é uma imagem válida
                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                        $valid_extensions = array("jpg", "jpeg", "png", "gif");

                        if (in_array($imageFileType, $valid_extensions)) {
                            // Tenta mover o arquivo para o diretório de upload
                            if (move_uploaded_file($_FILES['IMAGEM']['tmp_name'], $target_file)) {
                                // Exibir a imagem carregada
                                echo "<h2>Imagem do Livro:</h2>";
                                echo "<img src='$target_file' alt='Imagem do livro' style='width: 200px; height: auto; border-radius: 10px;'>";
                            } else {
                                echo "Houve um erro ao carregar a imagem.";
                            }
                        } else {
                            echo "Somente arquivos de imagem são permitidos (jpg, jpeg, png, gif).";
                        }
                    }
                    ?>

                    <label for="estado">Estado:</label><br>
                    <select id="estado" name="ESTADO" required>
                        <option value="" disabled selected>Estado</option>
                        <option value="NOVO">Novo</option>
                        <option value="SEMINOVO">Seminovo</option>
                        <option value="USADO">Usado</option>
                    </select><br>


                    <input type="submit" value="Cadastrar Livro" id="submit">
                </form>
                </form>
            </div>
        </div>
    </main>
</body>

</html>