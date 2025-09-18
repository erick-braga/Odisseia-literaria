<?php
session_start();

// Se não estiver logado, manda de volta para o login
if (!isset($_SESSION['cpf'])) {
    header("Location: logim.php");
    exit;
}

$cpf = $_SESSION['cpf'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Área Restrita</title>
</head>
    <div id="nav-her">
        <nav class="nav container">
            <a href="index.html" style="border: 0;"><img src="img/Logo.png" class="nav__logo" alt=""></a>
            <ul class="nav__list">
                <li class="nav__item"><a href="index.html" class="nav__link">Inicio</a></li>
                <li class="nav__item"><a href="cadastro.php" class="nav__link">Cadastrar</a></li>
                <li class="nav__item"><a href="ver.php" class="nav__link">Livros</a></li>
                <li class="nav__item"><a href="geraplanilha.php" class="nav__link">Gerar json</a></li>
                <li class="nav__item"><a href="logim.php" class="nav__link">logim</a></li>
                <li class="nav__item"><a href="cadastro_usuario.php" class="nav__link">cadastro cliente</a></li>
            </ul>
            <figure class="nav__menu">
                <img src="img/menu.svg" class="nav__icon">
            </figure>
        </nav>
    </div>

<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($cpf); ?>!</h1>
    <p>Você está logado no sistema.</p>
    <a href="logout.php">Sair</a>
</body>
</html>

