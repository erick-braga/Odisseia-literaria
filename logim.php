<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conecxao.php");

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = trim($_POST['cpf'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($cpf) || empty($senha)) {
        $erro = "Preencha todos os campos!";
    } else {
        /*   ERRADO      $sql = "SELECT cpf, nome, senha FROM clientes WHERE cpf = ?";

         */
        $sql = "SELECT cpf, senha FROM clientes WHERE cpf = ?";

        $stmt = $conexao->prepare($sql);

        if (!$stmt) {
            die("Erro no prepare: " . $conexao->error);
        }

        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($cpf_db, $senhaHash);

/*             $stmt->bind_result($id, $nome, $senhaHash);
 */            $stmt->fetch();

            if (password_verify($senha, $senhaHash)) {
                $_SESSION['usuario_id'] = $id;
                $_SESSION['usuario_cpf'] = $cpf;
                $_SESSION['logado'] = true;

                header("Location: area_restrita.php");
                exit;
            } else {
                $erro = "Senha incorreta!";
            }
        } else {
            $erro = "Cliente não encontrado!";
        }

        $stmt->close();
    }
}
$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <title>Login | </title>
    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/mobile.css" media="screen and (max-width: 600px)">
    <link rel="stylesheet" href="estilos/laptop.css" media="screen and (max-width: 1500px)">
    <link rel="stylesheet" href="estilos/laptop-1.css" media="screen and (max-width: 950px)">
    <link rel="stylesheet" href="estilos/tablet.css" media="screen and (max-width: 699px)">
    <link rel="stylesheet" href="estilos/style002.css">
    <link rel="stylesheet" href="estilos/mobile2.css" media="screen and (max-width: 500px)">

    <style>
        :root {
            --roxo-profundo: #1d0031;
            --roxo-claro: #4a1e7a;
            --cinza-claro: #f8f9fa;
            --branco: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .nav {
            grid-area: nav;
            display: grid;
            justify-content: space-between;
            grid-auto-flow: column;
            gap: 1em;
            align-items: center;
            height: 90px;
            padding: 0 2rem;
        }

        .nav__list {
            list-style: none;
            display: grid;
            grid-auto-flow: column;
            gap: 2em;
        }

        .nav__link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .nav__link:hover {
            color: #b19cd9;
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

        /* Container Principal */
        .login-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-card {
            background: var(--branco);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--roxo-profundo), var(--roxo-claro));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
        }

        .login-title {
            color: var(--roxo-profundo);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-subtitle {
            color: #666;
            font-size: 1rem;
        }

        /* Campos do Formulário */
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--roxo-claro);
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--cinza-claro);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--roxo-claro);
            background: var(--branco);
            box-shadow: 0 0 0 3px rgba(74, 30, 122, 0.1);
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--roxo-profundo);
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Botão */
        .btn-login {
            background: linear-gradient(135deg, var(--roxo-profundo), var(--roxo-claro));
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(74, 30, 122, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Links */
        .login-links {
            text-align: center;
            margin-top: 2rem;
        }

        .login-link {
            color: var(--roxo-claro);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .login-link:hover {
            color: var(--roxo-profundo);
            text-decoration: underline;
        }

        /* Mensagem de Erro */
        .alert-error {
            background: #ffe6e6;
            color: #d63031;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ff7675;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 500;
        }

        /* Responsividade */
        @media (max-width: 800px) {
            .nav__list {
                display: none;
            }

            .nav__menu {
                display: block;
            }

            .login-card {
                padding: 2rem;
                margin: 1rem;
            }

            .login-logo {
                width: 100px;
                height: 100px;
                font-size: 2rem;
            }

            .login-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 1.5rem;
            }

            .nav {
                padding: 0 1rem;
            }

            .nav__logo {
                width: 150px;
            }
        }

        /* Animações */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card {
            animation: fadeIn 0.6s ease-out;
        }
    </style>
</head>

<body>
    <div id="nav-her">
        <nav class="nav container">
            <a href="index.html" style="border: 0;"><img src="img/Logo.png" class="nav__logo" alt="Logo do Sistema"></a>
            <ul class="nav__list">
                <li class="nav__item"><a href="index.html" class="nav__link">Inicio</a></li>
                <li class="nav__item"><a href="cadastro.php" class="nav__link">Cadastrar</a></li>
                <li class="nav__item"><a href="ver.php" class="nav__link">Livros</a></li>
                <li class="nav__item"><a href="logim.php" class="nav__link">Login</a></li>
            </ul>
            <figure class="nav__menu">
                <img src="img/menu.svg" class="nav__icon" alt="Menu">
            </figure>
        </nav>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <i class="fas fa-book-reader"></i>
                </div>
                <h1 class="login-title">Bem-vindo de volta</h1>
                <p class="login-subtitle">Faça login em sua conta</p>
            </div>

            <?php if (!empty($erro)): ?>
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="icpf" class="form-label">CPF</label>
                    <i class="fas fa-user"></i>
                    <input type="text" name="cpf" id="icpf" class="form-control"
                        placeholder="Digite seu CPF (somente números)" required maxlength="11" pattern="[0-9]{11}"
                        title="Digite apenas números (11 dígitos)">
                </div>

                <div class="form-group">
                    <label for="isenha" class="form-label">Senha</label>
                    <i class="fas fa-lock"></i>
                    <input type="password" id="isenha" name="senha" class="form-control" placeholder="Digite sua senha"
                        required minlength="6">
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Entrar
                </button>
            </form>

            <div class="login-links">
                <p>Não possui conta? <a href="cadastro_usuario.php" class="login-link">Criar conta</a></p>
                <!--                 <p><a href="recuperar_senha.php" class="login-link">Esqueci minha senha</a></p>
 -->
            </div>
        </div>
    </div>

    <script>

        document.getElementById('icpf').addEventListener('input', function (e) {
            this.value = this.value.replace(/\D/g, '');
        });

        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function () {
                this.parentElement.classList.add('focused');
            });
            input.addEventListener('blur', function () {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });

        document.querySelector('form').addEventListener('submit', function (e) {
            const cpf = document.getElementById('icpf').value;
            const senha = document.getElementById('isenha').value;

            if (!cpf || !senha) {
                e.preventDefault();
                alert('Por favor, preencha todos os campos.');
                return;
            }

            if (cpf.length !== 11) {
                e.preventDefault();
                alert('CPF deve ter 11 dígitos.');
                return;
            }
        });
    </script>
</body>

</html>