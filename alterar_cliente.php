<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

include("conecxao.php");

function clean($v)
{
    return htmlspecialchars(trim($v));
}

// =======================
// VERIFICAR CPF
// =======================
if (!isset($_GET['cpf'])) {
    die("CPF não fornecido!");
}

$cpf = clean($_GET['cpf']);

// =======================
// BUSCAR DADOS EXISTENTES
// =======================
$stmt = $conexao->prepare("SELECT c.cpf, d.nome, d.sobrenome, d.genero, d.nascimento, d.fone, d.longadouro, d.numero, d.complemento, d.bairro, d.cidade, d.estado, d.cep 
FROM clientes c JOIN dados d ON c.cpf=d.cpf WHERE c.cpf=?");
$stmt->bind_param("s", $cpf);
$stmt->execute();
$result = $stmt->get_result();
$cliente = $result->fetch_assoc();
$stmt->close();

if (!$cliente) {
    die("Cliente não encontrado!");
}

// =======================
// PROCESSAR ALTERAÇÃO
// =======================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $senha = $_POST['senha'] ?? '';
    $nome = clean($_POST['nome']);
    $sobrenome = clean($_POST['sobrenome']);
    $genero = clean($_POST['genero']);
    $nascimento = $_POST['nascimento'] ?? '';
    $fone = clean($_POST['fone']);
    $longadouro = clean($_POST['longadouro']);
    $numero = clean($_POST['numero']);
    $complemento = clean($_POST['complemento']);
    $bairro = clean($_POST['bairro']);
    $cidade = clean($_POST['cidade']);
    $estado = clean($_POST['estado']);
    $cep = clean($_POST['cep']);

    // Atualizar senha apenas se preenchida
    if (!empty($senha)) {
        $hash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $conexao->prepare("UPDATE clientes SET senha=? WHERE cpf=?");
        $stmt->bind_param("ss", $hash, $cpf);
        $stmt->execute();
        $stmt->close();
    }

    // Atualizar dados
    $stmt = $conexao->prepare("UPDATE dados SET nome=?, sobrenome=?, genero=?, nascimento=?, fone=?, longadouro=?, numero=?, complemento=?, bairro=?, cidade=?, estado=?, cep=? WHERE cpf=?");
    $stmt->bind_param("sssssssssssss", $nome, $sobrenome, $genero, $nascimento, $fone, $longadouro, $numero, $complemento, $bairro, $cidade, $estado, $cep, $cpf);
    $stmt->execute();
    $stmt->close();

    header("Location: listar.php"); // voltar para listagem
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
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
    <meta charset="UTF-8">
    <title>Alterar dados do cliente | Odisséia Literária</title>
    <style>
        label {
            display: block;
            margin-top: 8px
        }

        input,
        select {
            width: 300px;
            padding: 5px;
            margin-top: 2px
        }

        button {
            margin-top: 10px;
            padding: 8px 12px;
            width: 100%;
            border: 0;
            padding: 10px;
            background-color: #1d0031;
            color: white;
            border-radius: 40px;
            transition: 0.4s ease-in-out;
        }

        button:hover {
            background: #1d0031d2;
        }

        a {

            display: block;
            margin: auto;
            text-align: center;
            width: 60px;
                        transition: 0.4s ease-in-out;

        }

        a:hover {
            background-color: #1d0031ff;

        }
    </style>
</head>

<body>

    <br><br>
    <div class="container">
        <div id="form">
            <h1>Alterar Cliente - <?php echo htmlspecialchars($cliente['cpf']); ?></h1><br>
            <form method="POST" action="">
                Senha: <input type="password" name="senha" placeholder="Digite para alterar"><br>
                Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>"
                    required><br>
                Sobrenome: <input type="text" name="sobrenome"
                    value="<?php echo htmlspecialchars($cliente['sobrenome']); ?>" required><br>
                Gênero:
                <label for="genero">Selecione seu gênero:</label>
                <select name="genero" id="genero" required>
                    <?php
                    $generos = [
                        "homem",
                        "mulher",
                        "transmasculino",
                        "transfeminino",
                        "naobinario",
                        "agenero",
                        "bigenero",
                        "pangenero",
                        "demiboy",
                        "demigirl",
                        "genderfluid",
                        "genderqueer",
                        "androgino",
                        "neutrois",
                        "two-spirit",
                        "intergenero",
                        "poligenero",
                        "maverique",
                        "omnigenero",
                        "x-gender",
                        "genderquestioning",
                        "gendernonconforming",
                        "gendervariant",
                        "androgyne",
                        "demiflux",
                        "autigenero",
                        "ceterogenero",
                        "greygender",
                        "neutro-gênero",
                        "floragenero",
                        "libragenero",
                        "novigenero",
                        "mirigenero",
                        "quarternario",
                        "omnisexual-gender",
                        "androsexual-gender",
                        "gynesexual-gender",
                        "skoliosexual-gender",
                        "demigender",
                        "subgender",
                        "novogender",
                        "transgenero",
                        "cisgenero",
                        "androqueer",
                        "gyniqueer",
                        "apogenero",
                        "ambigenero",
                        "exogenero",
                        "outra"
                    ];
                    foreach ($generos as $g) {
                        $selected = ($cliente['genero'] === $g) ? 'selected' : '';
                        echo "<option value=\"$g\" $selected>" . ucfirst($g) . "</option>";
                    }
                    ?>
                </select><br>
                Nascimento: <input type="date" name="nascimento"
                    value="<?php echo htmlspecialchars($cliente['nascimento']); ?>" required><br>
                Fone: <input type="text" name="fone" value="<?php echo htmlspecialchars($cliente['fone']); ?>"><br>
                Logradouro: <input type="text" name="longadouro"
                    value="<?php echo htmlspecialchars($cliente['longadouro']); ?>"><br>
                Número: <input type="text" name="numero"
                    value="<?php echo htmlspecialchars($cliente['numero']); ?>"><br>
                Complemento: <input type="text" name="complemento"
                    value="<?php echo htmlspecialchars($cliente['complemento']); ?>"><br>
                Bairro: <input type="text" name="bairro"
                    value="<?php echo htmlspecialchars($cliente['bairro']); ?>"><br>
                Cidade: <input type="text" name="cidade"
                    value="<?php echo htmlspecialchars($cliente['cidade']); ?>"><br>
                Estado: <input type="text" name="estado"
                    value="<?php echo htmlspecialchars($cliente['estado']); ?>"><br>
                CEP: <input type="text" name="cep" value="<?php echo htmlspecialchars($cliente['cep']); ?>"><br>
                <br>

                <button type="submit">Salvar Alterações</button>
            </form>
        </div>
    </div>



    <hr style="width: 400px; height: 3px; background-color: white; margin: auto; margin-top: 20px; margin-bottom: 20px">


    <a href="listar.php"
        style="background-color: #8857a8ff; width:300px; color; padding: 10px; border-radius: 30px;">Voltar para
        Listagem</a>
</body>

</html>