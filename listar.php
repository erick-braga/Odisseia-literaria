<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);

include("conecxao.php");

// função para limpar dados
function clean($v){ return htmlspecialchars(trim($v)); }

if(isset($_GET['excluir'])){
    $cpf = clean($_GET['excluir']);
    // Exclui primeiro da tabela dados, depois clientes
    $stmt = $conexao->prepare("DELETE FROM dados WHERE cpf=?");
    $stmt->bind_param("s",$cpf);
    $stmt->execute();
    $stmt->close();

    $stmt = $conexao->prepare("DELETE FROM clientes WHERE cpf=?");
    $stmt->bind_param("s",$cpf);
    $stmt->execute();
    $stmt->close();

    header("Location: listar.php");
    exit;
}

$busca = $_GET['busca'] ?? '';
if(!empty($busca)){
    $like = "%$busca%";
    $stmt = $conexao->prepare("SELECT c.cpf, d.nome, d.sobrenome, d.genero, d.nascimento, d.fone, d.longadouro, d.numero, d.complemento, d.bairro, d.cidade, d.estado, d.cep 
        FROM clientes c 
        JOIN dados d ON c.cpf=d.cpf 
        WHERE c.cpf LIKE ? OR d.nome LIKE ? OR d.sobrenome LIKE ? OR d.genero LIKE ? OR d.cidade LIKE ? 
        ORDER BY d.nome, d.sobrenome");
    $stmt->bind_param("sssss",$like,$like,$like,$like,$like);
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
<title>Clientes</title>
<style>
table{border-collapse:collapse;width:100%}
th,td{border:1px solid #ccc;padding:8px;text-align:left}
th{background:#f2f2f2}
.btn{padding:5px 10px;text-decoration:none;border-radius:4px;margin-right:3px}
.btn-edit{background:#4CAF50;color:white}
.btn-delete{background:#f44336;color:white}
</style>
</head>
<body>
<h1>Clientes</h1>

<form method="GET" action="">
<input type="text" name="busca" placeholder="Pesquisar..." value="<?php echo htmlspecialchars($busca); ?>">
<button type="submit">Buscar</button>
</form>

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

<?php while($row = $result->fetch_assoc()): ?>
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
<a href="?excluir=<?php echo $row['cpf']; ?>" class="btn btn-delete" onclick="return confirm('Deseja excluir?');">Excluir</a>
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

