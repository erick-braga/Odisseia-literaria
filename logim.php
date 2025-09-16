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
        $sql = "SELECT senha FROM clientes WHERE cpf = ?";
        $stmt = $conexao->prepare($sql);

        if (!$stmt) {
            die("Erro no prepare: " . $conexao->error);
        }

        $stmt->bind_param("s", $cpf);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($senhaHash);
            $stmt->fetch();

            if (password_verify($senha, $senhaHash)) {
                $_SESSION['cpf'] = $cpf;
                header("Location: area_restrita.php");
                exit;
            } else {
                $erro = "⚠️ Senha incorreta!";
            }
        } else {
            $erro = "⚠️ Cliente não encontrado!";
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
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Login</h1>
        <form method="POST" action="">
            <input type="text" name="cpf" placeholder="CPF (somente números)" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <br><br>
            <button type="submit">Entrar</button>
        </form>
        <?php if (!empty($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    </div>
</body>
</html>

