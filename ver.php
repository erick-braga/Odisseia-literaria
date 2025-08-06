<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'conecxao.php';

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Excluir livro
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $stmt = $conexao->prepare("DELETE FROM LIVRARIA WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ver.php");
    exit;
}

// Buscar livros
$sql = "SELECT ID, TITULO, AUTOR, EDITORA, VALOR_COMPRA, ANO_PUBLICACAO, ESTADO, IMAGEM FROM LIVRARIA";
$resultado = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Acervo Literário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap');

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
/*             box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
 */            display: flex;
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
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .card-livro p {
            font-size: 0.9rem;
            margin: 2px 0;
            text-align: center;
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
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.html">
                <img src="img/Logo.png" alt="Logo">
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mx-auto" style="font-size: 1.5rem;">
                    <li class="nav-item"><a class="nav-link text-white" href="index.html">Início</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="cadastro.php">Cadastro</a></li>
                    <li class="nav-item"><a class="nav-link disabled text-white-50" href="#">Comprar</a></li>
                </ul>
            </div>
        </div>
    </nav>
<div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <a href="cadastro.html" class="link-cadastro">Cadastrar Novo Livro</a>
    <h1 class="titulo-pagina">Acervo de Livros</h1>

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
                    <p class="preco">R$ <?= number_format($livro['VALOR_COMPRA'], 2, ',', '.') ?></p>
                    <div class="botoes">
                        <form method="get" action="">
                            <input type="hidden" name="excluir" value="<?= $livro['ID'] ?>">
                            <button type="submit" class="btn-excluir"
                                onclick="return confirm('Tem certeza que deseja excluir este livro?')">Excluir</button>
                        </form>
                        <form method="get" action="editar.php">
                            <input type="hidden" name="id" value="<?= $livro['ID'] ?>">
                            <button type="submit" class="btn-editar">Editar</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p style="text-align: center; color: white;">Nenhum livro cadastrado no acervo.</p>
    <?php endif; ?>

    <?php $conexao->close(); ?>
</body>

</html>