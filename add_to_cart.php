<?php
session_start();

function adicionarAoCarrinho($id, $nome, $preco, $qtd = 1)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $qtd;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'nome' => $nome,
            'preco' => $preco,
            'qty' => $qtd
        ];
    }
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
$preco = isset($_POST['preco']) ? (float) $_POST['preco'] : 0;
$qtd = isset($_POST['qtd']) ? (int) $_POST['qtd'] : 1;

if ($id > 0 && $nome !== '' && $preco > 0 && $qtd > 0) {
    adicionarAoCarrinho($id, $nome, $preco, $qtd);
    header('Location: carrinho.php');
    exit;
} else {
    echo "Erro: dados do produto inválidos.<br>";
    echo "DEBUG → ";
    var_dump($_POST);
}
?>