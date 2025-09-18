<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso! | Odisséia Literária</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <style>
        body {
            background-color: #2f024dff;
        }

        #center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 99vh;

        }

        #p {
            padding: 60px;
            color: black;
            background-color: white;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border-radius: 20px;
            text-align: center;
        }

        a {
            color: #2f024df;

        }
    </style>
</head>

<body>

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
    <div id='p'>Cadastro realizado com sucesso!  <br><br>  <a href='logim.php'>Fazer login na conta</a>.
</div>
    </div>
    ";

    $conexao->close();
}
?>