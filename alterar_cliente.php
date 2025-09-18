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
    <meta charset="UTF-8">
    <title>Alterar Cliente</title>
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
            padding: 8px 12px
        }
    </style>
</head>

<body>
    <h1>Alterar Cliente - <?php echo htmlspecialchars($cliente['cpf']); ?></h1>

    <form method="POST" action="">
        Senha: <input type="password" name="senha" placeholder="Digite para alterar"><br>
        Nome: <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required><br>
        Sobrenome: <input type="text" name="sobrenome" value="<?php echo htmlspecialchars($cliente['sobrenome']); ?>"
            required><br>
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

        Nascimento: <input type="date" name="nascimento" value="<?php echo htmlspecialchars($cliente['nascimento']); ?>"
            required><br>
        Fone: <input type="text" name="fone" value="<?php echo htmlspecialchars($cliente['fone']); ?>"><br>
        Logradouro: <input type="text" name="longadouro"
            value="<?php echo htmlspecialchars($cliente['longadouro']); ?>"><br>
        Número: <input type="text" name="numero" value="<?php echo htmlspecialchars($cliente['numero']); ?>"><br>
        Complemento: <input type="text" name="complemento"
            value="<?php echo htmlspecialchars($cliente['complemento']); ?>"><br>
        Bairro: <input type="text" name="bairro" value="<?php echo htmlspecialchars($cliente['bairro']); ?>"><br>
        Cidade: <input type="text" name="cidade" value="<?php echo htmlspecialchars($cliente['cidade']); ?>"><br>
        Estado: <input type="text" name="estado" value="<?php echo htmlspecialchars($cliente['estado']); ?>"><br>
        CEP: <input type="text" name="cep" value="<?php echo htmlspecialchars($cliente['cep']); ?>"><br>
        <button type="submit">Salvar Alterações</button>
    </form>

    <br>
    <a href="listar.php">Voltar para Listagem</a>
</body>

</html>