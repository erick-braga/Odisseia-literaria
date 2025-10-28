<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conecxao.php");

// função para limpar dados
function clean($v)
{
    return htmlspecialchars(trim($v));
}

if (isset($_GET['excluir'])) {
    $cpf = clean($_GET['excluir']);
    // Exclui primeiro da tabela dados, depois clientes
    $stmt = $conexao->prepare("DELETE FROM dados WHERE cpf=?");
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->close();

    $stmt = $conexao->prepare("DELETE FROM clientes WHERE cpf=?");
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $stmt->close();

    header("Location: listar.php");
    exit;
}

$busca = $_GET['busca'] ?? '';
if (!empty($busca)) {
    $like = "%$busca%";
    $stmt = $conexao->prepare("SELECT c.cpf, d.nome, d.sobrenome, d.genero, d.nascimento, d.fone, d.longadouro, d.numero, d.complemento, d.bairro, d.cidade, d.estado, d.cep 
        FROM clientes c 
        JOIN dados d ON c.cpf=d.cpf 
        WHERE c.cpf LIKE ? OR d.nome LIKE ? OR d.sobrenome LIKE ? OR d.genero LIKE ? OR d.cidade LIKE ? 
        ORDER BY d.nome, d.sobrenome");
    $stmt->bind_param("sssss", $like, $like, $like, $like, $like);
} else {
    $stmt = $conexao->prepare("SELECT c.cpf, d.nome, d.sobrenome, d.genero, d.nascimento, d.fone, d.longadouro, d.numero, d.complemento, d.bairro, d.cidade, d.estado, d.cep 
        FROM clientes c 
        JOIN dados d ON c.cpf=d.cpf 
        ORDER BY d.nome, d.sobrenome");
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title> Visualizar clientes | Página Inicial </title>

    <?php
    session_start();

    // Se não estiver logado, manda de volta para o login
    if (!isset($_SESSION['cpf'])) {
        header("Location: login.php");
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

        <link rel="stylesheet" href="estilos/style.css">
        <link rel="stylesheet" href="estilos/mobile.css" media="screen and (max-width: 600px)">
        <link rel="stylesheet" href="estilos/laptop.css" media="screen and (max-width: 1500px)">
        <link rel="stylesheet" href="estilos/laptop-1.css" media="screen and (max-width: 950px)">
        <link rel="stylesheet" href="estilos/tablet.css" media="screen and (max-width: 699px)">
        <link rel="stylesheet" href="estilos/style002.css">
        <link rel="stylesheet" href="estilos/mobile2.css" media="screen and (max-width: 500px)">



        <style>
            body {
                background-color: white;
                height: 500vh;
            }

            ::-webkit-scrollbar {
                width: 0px;
                height: 0px;
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
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            border-radius: 20px;
            margin: auto;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left
        }

        th {
            background: #f2f2f2
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 3px
        }

        .btn-edit {
            background: #4CAF50;
            color: white
        }

        .btn-delete {
            background: #f44336;
            color: white
        }

        #busca {
            border-radius: 15px 15px 0px 0px;
        }

        #busca,
        #sub {
            width: 50%;

        }

        #sub {
            border-radius: 0px 0px 15px 15px;
        }

        form {
            text-align: center;
        }

        #center {
            display: block;
            margin: auto;
        }

        #center>h1 {
            text-align: center;
        }

        h1 {
            font-weight: bolder;
            font-size: 3.1em;
            color: white;
        }
    </style>

    </head>

    <body><br>

        <div id="center">
            <h1>Visualização de clientes com cadastro</h1>
            <form method="GET" action="">
                <input type="text" name="busca" id="busca" placeholder="Pesquisar..."
                    value="<?php echo htmlspecialchars($busca); ?>">
                <button type="submit" id="sub">Buscar</button>
            </form>
        </div>

        <br>

        <table>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Gênero</th>
                <th>Nascimento</th>
                <th>Fone</th>
                <th>Cidade</th>
                <th>Ações</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['cpf']); ?></td>
                    <td><?php echo htmlspecialchars($row['nome']); ?></td>
                    <td><?php echo htmlspecialchars($row['sobrenome']); ?></td>
                    <td><?php echo htmlspecialchars($row['genero']); ?></td>
                    <td><?php echo htmlspecialchars($row['nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($row['fone']); ?></td>
                    <td><?php echo htmlspecialchars($row['cidade']); ?></td>
                    <td>
                        <a href="alterar_cliente.php?cpf=<?php echo $row['cpf']; ?>" class="btn btn-edit">Alterar</a>
                        <a href="?excluir=<?php echo $row['cpf']; ?>" class="btn btn-delete"
                            onclick="return confirm('Deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </body>

</html>

<?php
$stmt->close();
$conexao->close();
?>