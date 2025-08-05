<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Livros | Cadastre seu livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="estilos/style002.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

</head>

<body>

    <nav class="navbar navbar-expand-lg" style="background-color: #1d0031; padding: 0.75rem 1rem;">
        <div class="container-fluid div-sla">
            <a class="navbar-brand text-white" href="#" style="margin-right: -220px;"><img src="img/Logo.png" id="img"
                    alt="" style="width: 180px; margin-left: 80px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                <ul class="navbar-nav mb-0 mb-lg-0  mx-auto" style="font-size: 2em;">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.html">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="cadastro.html">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled text-white-50" aria-disabled="true" href="ver.php">Comprar</a>
                    </li>
                </ul>


            </div>
        </div>
    </nav>
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
                    <input type="number" id="ano" name="ANO_PUBLICACAO" required placeholder="Ano"><br>

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