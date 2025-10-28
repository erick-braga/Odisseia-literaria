<?php
session_start();

/**
 * Adiciona um produto ao carrinho.
 *
 * @param int $id ID do produto
 * @param string $nome Nome do produto
 * @param float $preco Preço do produto
 * @param int $quantidade Quantidade (padrão = 1)
 */
function adicionarAoCarrinho($id, $nome, $preco, $quantidade = 1)
{

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qty'] += $quantidade;
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'nome' => $nome,
            'preco' => $preco,
            'qty' => $quantidade
        ];
    }
}


function getCarrinho()
{
    return $_SESSION['cart'] ?? [];
}

function limparCarrinho()
{
    unset($_SESSION['cart']);
}
?>