<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    exit('OK'); 
}

$termo = '';

if (isset($_GET['busca']) && !empty($_GET['busca'])) {
    $termo = $conexao->real_escape_string($_GET['busca']);
    $sql = "SELECT ID, TITULO, AUTOR, EDITORA, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO, IMAGEM 
            FROM LIVRARIA 
            WHERE TITULO LIKE '%$termo%'
            OR AUTOR LIKE '%$termo%'
            OR EDITORA LIKE '%$termo%'
            OR VALOR_COMPRA LIKE '%$termo%'
            OR ANO_PUBLICACAO LIKE '%$termo%'
            OR ESTADO LIKE '%$termo%'";
} else {
    $sql = "SELECT ID, TITULO, AUTOR, EDITORA, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO, IMAGEM FROM LIVRARIA";
}

$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Acervo Literário | Odisséia Literária</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap');

        ::-webkit-scrollbar {
            width: 0;
        }

        :root {
            --font: 'Caudex', serif;
            --roxo-profundo: #1d0031;
            --lavanda-suave: #C8A2C8;
            --berinjela-neutro: #5D496B;
            --lilas-claro: #E8DAEF;
            --verde-destaque: #0cae98;
        }

        body {
            font-family: var(--font);
            color: white;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--roxo-profundo);
            padding: 0.75rem 1rem;
        }

        .navbar-brand img {
            width: 200px;
        }

        .titulo-pagina {
            text-align: center;
            margin: 2rem 0 1rem;
            font-size: 2.5rem;
            font-weight: bold;
            color: black;
        }

        .link-cadastro {
            display: block;
            text-align: center;
            margin-bottom: 2rem;
            font-weight: bold;
            color: var(--verde-destaque);
            text-decoration: none;
        }

        .grid-livros {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            padding: 0 5%;
            margin-bottom: 3rem;
        }

        .card-livro {
            border-radius: 10px;
            padding: 1rem;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s;
        }

        .card-livro:hover {
            transform: scale(1.02);
        }

        .card-livro img {
            width: 100%;
            height: 280px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .card-livro h3 {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
        }

        .card-livro p {
            font-size: 0.9rem;
            margin: 2px 0;
            text-align: left;
        }

        .preco {
            font-weight: bold;
            color: var(--roxo-profundo);
            margin-top: 0.5rem;
        }

        .botoes {
            display: flex;
            gap: 10px;
            margin-top: 1rem;
        }

        .btn-editar,
        .btn-excluir {
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .btn-editar {
            background-color: var(--roxo-profundo);
            width: 100%;
            color: white;
        }

        .btn-excluir {
            background-color: var(--roxo-profundo);
            width: 100%;
            color: white;
        }

        .todo {
            background-image: linear-gradient(to top, var(--roxo-profundo)20%, #440072);
            width: 100vw;
            padding: 0px 0px 20px 0px;
            margin-bottom: -30px;
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

        #imgss {
            height: 30px;
            width: 400px;
        }

        #imgss>img {
            object-fit: cover;
        }

        #ccard {
            margin-top: 30px;
            background-image: url("img/livros.jpg");
            height: 600px;
            width: 100%;
            background-attachment: fixed;
            background-size: cover;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #111111bd;
            display: flex;
            opacity: 0;
            pointer-events: none;
            transition: opacity .6s .9s;
            --transform: translateY(-100vh);
            --transition: transform .8s;
        }

        .modal--show {
            opacity: 1;
            pointer-events: unset;
            transition: opacity .6s;
            --transform: translateY(0);
            --transition: transform .8s .8s;
        }

        .modal__container {
            margin: auto;
            width: 90%;
            max-width: 600px;
            max-height: 90%;
            background-color: #fff;
            border-radius: 6px;
            padding: 3em 2.5em;
            display: grid;
            gap: 1em;
            place-items: center;
            grid-auto-columns: 100%;
            transform: var(--transform);
            transition: var(--transition);
        }

        .modal__title {
            font-size: 2.5rem;
        }

        .modal__paragraph {
            margin-bottom: 10px;
        }

        .modal__img {
            width: 90%;
            max-width: 300px;
        }

        .modal__close {
            text-decoration: none;
            color: #fff;
            background-color: #F26250;
            padding: 1em 3em;
            border: 1px solid;
            border-radius: 6px;
            display: inline-block;
            font-weight: 300;
            transition: background-color .3s;
        }

        .modal__close:hover {
            color: #F26250;
            background-color: #fff;
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

            #link-a:hover {
                background-color: rgba(65, 0, 82, 1);
            }

            form {
                border: 1px solid black;
            }

            #o>input {
                display: block;
            }
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: var(--roxo-profundo);
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="todo">
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

    <div id="ccard"></div>
    <br>

    <form id="form-busca" style="text-align: center; margin-bottom: 30px;">
        <input type="text" name="busca" id="busca" placeholder="Buscar por título, autor, editora..."
            value="<?= htmlspecialchars($termo) ?>"
            style="padding: 10px; width: 300px; border-radius: 6px; border: 1px solid #ccc;">
        <button type="submit"
            style="padding: 10px 20px; background-color: #1d0031; color: white; border: none; border-radius: 6px;">Buscar</button>
    </form>

    <h1 class="titulo-pagina">Acervo de Livros (cadastrado)</h1>
    <hr style="margin: auto; margin-bottom: 30px; text-align: center; height: 2px; width: 60%; color: black;">

    <div id="resultado-livros">
        <?php if ($resultado->num_rows > 0): ?>
            <div class="grid-livros">
                <?php while ($livro = $resultado->fetch_assoc()): ?>
                    <div class="card-livro">
                        <?php if (!empty($livro['IMAGEM'])): ?>
                            <img src="images/<?= $livro['IMAGEM'] ?>" alt="Capa do livro">
                        <?php else: ?>
                            <img src="images/sem-imagem.jpg" alt="Sem imagem">
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($livro['TITULO']) ?></h3>
                        <p><strong>Autor:</strong> <?= htmlspecialchars($livro['AUTOR']) ?></p>
                        <p><strong>Editora:</strong> <?= htmlspecialchars($livro['EDITORA']) ?></p>
                        <p><strong>Ano:</strong> <?= $livro['ANO_PUBLICACAO'] ?></p>
                        <p><strong>Estado:</strong> <?= $livro['ESTADO'] ?></p>
                        <p class="preco" style="font-size: 1.3em;">R$ <?= number_format($livro['VALOR_COMPRA'], 2, ',', '.') ?></p>
                        <div class="botoes">
                            <button type="button" class="btn-excluir" data-id="<?= $livro['ID'] ?>"
                                onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                            <form method="get" action="editar.php" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $livro['ID'] ?>">
                                <button type="submit" class="btn-editar">Editar</button>
                            </form>
                        </div>
                        <br>
                        <form action="add_to_cart.php" method="post" id="o" style="margin-top: -50px">
                            <input type="hidden" name="id" value="<?= $livro['ID'] ?>">
                            <input type="hidden" name="nome" value="<?= htmlspecialchars($livro['TITULO']) ?>">
                            <input type="hidden" name="preco" value="<?= $livro['VALOR_COMPRA'] ?>">
                            <br><br><br>
                            <label style="font-weight: bold">Quantidade:</label>
                            <input type="number" name="qtd" value="1" min="0" style="width: 40px">
                            <button type="submit">🛒</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: black;">Nenhum livro encontrado.</p>
        <?php endif; ?>
    </div>

    <?php $conexao->close(); ?>

    <a href="cadastro.php" style="width: 100%; padding: 20px; background-color: #1d0031; margin-bottom: -60px; color: white;" 
       class="link-cadastro" id="link-a">Cadastrar Novo Livro</a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(function () {
        let timeoutId;
        
        $('#busca').on('input', function () {
            clearTimeout(timeoutId);
            const termo = $(this).val();
            
            $('#resultado-livros').html('<div class="loading">Buscando livros...</div>');
            
            timeoutId = setTimeout(() => {
                buscarLivros(termo);
            }, 500);
        });

        $('#form-busca').on('submit', function (e) {
            e.preventDefault();
            const termo = $('#busca').val();
            buscarLivros(termo);
        });

        $(document).on('click', '.btn-excluir', function (e) {
            e.preventDefault();
            if (!confirm('Tem certeza que deseja excluir este livro?')) return;
            
            const id = $(this).data('id');
            const card = $(this).closest('.card-livro');
            
            $.ajax({
                url: 'ver.php',
                type: 'GET',
                data: { excluir: id },
                success: function () {
                    card.fadeOut(300, function() {
                        $(this).remove();
                        const livrosRestantes = $('.card-livro').length;
                        if (livrosRestantes === 0) {
                            $('#resultado-livros').html('<p style="text-align: center; color: black;">Nenhum livro encontrado.</p>');
                        }
                    });
                },
                error: function () {
                    alert('Erro ao excluir livro.');
                }
            });
        });

        function buscarLivros(termo) {
            $.ajax({
                url: 'ver.php',
                type: 'GET',
                data: { busca: termo },
                success: function (resposta) {
                    const tempDiv = $('<div>').html(resposta);
                    const conteudo = tempDiv.find('#resultado-livros').html();
                    $('#resultado-livros').html(conteudo);
                },
                error: function () {
                    $('#resultado-livros').html('<p style="text-align: center; color: black;">Erro ao buscar livros.</p>');
                }
            });
        }
    });
    </script>
</body>
</html>