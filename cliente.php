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
        #center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 99vh;
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
                <li class="nav__item"><a href="logim.php" class="nav__link">Entrar</a></li>

            </ul>
            <figure class="nav__menu">
                <img src="img/menu.svg" class="nav__icon">
            </figure>
        </nav>
    </div>

    <div class="icontainer">
        <div id="form">
            <h2>Cadastre sua conta</h2>
            <form action="inserir_dados_clientes.php" method="post">
                <input type="text" name="nome" placeholder="Nome" required><br>
                <input type="text" name="sobrenome" placeholder="Sobrenome" required><br>
                <input type="text" name="cpf" placeholder="CPF" required><br>
                <input type="password" name="senha" placeholder="Senha" required><br>

                <label for="genero">Selecione seu gênero:</label>
                <select name="genero" id="genero" required>
                    <option value="homem">Homem</option>
                    <option value="mulher">Mulher</option>
                    <option value="transmasculino">Transmasculino</option>
                    <option value="transfeminino">Transfeminino</option>
                    <option value="naobinario">Não-binário</option>
                    <option value="agenero">Agênero</option>
                    <option value="bigenero">Bi-gênero</option>
                    <option value="pangenero">Pan-gênero</option>
                    <option value="demiboy">Demiboy</option>
                    <option value="demigirl">Demigirl</option>
                    <option value="genderfluid">Genderfluid</option>
                    <option value="genderqueer">Genderqueer</option>
                    <option value="androgino">Andrógino</option>
                    <option value="neutrois">Neutrois</option>
                    <option value="two-spirit">Two-Spirit</option>
                    <option value="intergenero">Intergênero</option>
                    <option value="poligenero">Poligênero</option>
                    <option value="maverique">Maverique</option>
                    <option value="omnigenero">Omnigênero</option>
                    <option value="x-gender">X-Gender</option>
                    <option value="genderquestioning">Questionando</option>
                    <option value="gendernonconforming">Não-conforme de gênero</option>
                    <option value="gendervariant">Variante de gênero</option>
                    <option value="androgyne">Andrógino (variação)</option>
                    <option value="demiflux">Demiflux</option>
                    <option value="autigenero">Autigênero</option>
                    <option value="ceterogenero">Ceterogênero</option>
                    <option value="greygender">Grey-gênero</option>
                    <option value="neutro-gênero">Neutro-gênero</option>
                    <option value="floragenero">Flora-gênero</option>
                    <option value="libragenero">Libra-gênero</option>
                    <option value="novigenero">Novigênero</option>
                    <option value="mirigenero">Miri-gênero</option>
                    <option value="quarternario">Quaternário</option>
                    <option value="omnisexual-gender">Omnisexual-gênero</option>
                    <option value="androsexual-gender">Androsexual-gênero</option>
                    <option value="gynesexual-gender">Gynessexual-gênero</option>
                    <option value="skoliosexual-gender">Skoliosexual-gênero</option>
                    <option value="demigender">Demigênero</option>
                    <option value="subgender">Subgênero</option>
                    <option value="novogender">Novo-gênero</option>
                    <option value="transgenero">Transgênero</option>
                    <option value="cisgenero">Cisgênero</option>
                    <option value="androqueer">Androqueer</option>
                    <option value="gyniqueer">Gyniqueer</option>
                    <option value="apogenero">Apogênero</option>
                    <option value="ambigenero">Ambigênero</option>
                    <option value="exogenero">Exogênero</option>
                    <option value="outra">Outra</option>
                </select><br>

                <input type="date" name="nascimento" required><br>
                <input type="tel" name="telefone" placeholder="(11) 91234-5678" pattern="\(\d{2}\) \d{4,5}-\d{4}"
                    required><br>
                <input type="text" name="logradouro" placeholder="Logadouro" required><br>
                <input type="number" name="numero" placeholder="Número" required><br>
                <input type="text" name="complemento" placeholder="Complemento"><br>
                <input type="text" name="bairro" placeholder="Bairro" required><br>
                <input type="text" name="cidade" placeholder="Cidade" required><br>
                <input type="text" name="estado" placeholder="Estado" required><br>
                <input type="text" name="cep" placeholder="CEP" required><br><br>

                <button type="submit">Cadastrar</button>
            </form>
            <br>
            <p style="text-align: center">Já possui conta? <a href="logim.php">Entrar na conta</a>.</p>


        </div>
    </div>
</body>

</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("conecxao.php");

if (!$conexao) {
    die("Erro: Conexão com o banco de dados falhou.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $logradouro = $_POST['logadouro'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $cep = $_POST['cep'] ?? '';

    $senhaHash = password_hash($senha, PASSWORD_BCRYPT);//cria hash da senha

    $sqlClientes = "INSERT INTO clientes (cpf, senha) VALUES (?, ?)";
    $stmt1 = $conexao->prepare($sqlClientes);
    if (!$stmt1) {
        die("Erro na preparação da query clientes: " . $conn->error);
    }
    $stmt1->bind_param("ss", $cpf, $senhaHash);
    $stmt1->execute();
    $stmt1->close();

    $sqlDados = "INSERT INTO dados 
        (cpf, nome, sobrenome, genero, nascimento, fone, longadouro, numero, complemento, bairro, cidade, estado, cep)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt2 = $conexao->prepare($sqlDados);
    if (!$stmt2) {
        die("Erro na preparação da query dados: " . $conexao->error);
    }
    $stmt2->bind_param(
        "sssssssssssss",
        $cpf,
        $nome,
        $sobrenome,
        $genero,
        $nascimento,
        $telefone,
        $logradouro,
        $numero,
        $complemento,
        $bairro,
        $cidade,
        $estado,
        $cep
    );
    $stmt2->execute();
    $stmt2->close();

    echo "<div id='center'>
    <p>Cadastro realizado com sucesso!</p>
    </div>";

    $conexao->close();
}
?>