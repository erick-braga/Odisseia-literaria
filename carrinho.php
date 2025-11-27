<?php
session_start();
include 'conecxao.php';

function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

$cart = $_SESSION['cart'] ?? [];

// Atualização via AJAX (sem reload)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $id => $qty) {
        $id = (int)$id;
        $qty = (int)$qty;
        if ($qty > 0 && isset($cart[$id])) {
            $cart[$id]['qty'] = $qty;
        }
    }

    $_SESSION['cart'] = $cart;

    // Recalcula total
    $total = 0.0;
    foreach ($cart as $item) {
        $total += $item['preco'] * $item['qty'];
    }

    // Retorna apenas o HTML do carrinho atualizado
    ob_start();
    ?>
    <table border="0" cellpadding="10">
        <tr>
            <th>Produto</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Subtotal</th>
        </tr>
        <?php foreach ($cart as $id => $item): ?>
            <tr>
                <td><?= e($item['nome']) ?></td>
                <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                <td><input type="number" name="qty[<?= $id ?>]" value="<?= $item['qty'] ?>" min="1"></td>
                <td>R$ <?= number_format($item['preco'] * $item['qty'], 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <button type="submit" name="update_cart" style="margin:auto">Atualizar quantidades</button>
    <br><br>
    <p style="font-weight: bold; font-size: 2em; text-decoration:underline">Total: R$ <?= number_format($total, 2, ',', '.') ?></p>
    <?php
    echo ob_get_clean();
    exit;
}

// Finalizar pedido normalmente
$total = 0.0;
foreach ($cart as $item) {
    $total += $item['preco'] * $item['qty'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar'])) {
    $nome = trim($_POST['cliente_nome']);
    $email = trim($_POST['cliente_email']);
    if ($nome && $email && !empty($cart)) {
        $conexao->begin_transaction();
        try {
            $stmt = $conexao->prepare("INSERT INTO pedidos (cliente_nome, cliente_email, total) VALUES (?, ?, ?)");
            $stmt->bind_param("ssd", $nome, $email, $total);
            $stmt->execute();
            $pedido_id = $stmt->insert_id;
            $stmt->close();

            $stmtItem = $conexao->prepare("INSERT INTO pedido_itens (pedido_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
            $stmtEst = $conexao->prepare("UPDATE pedido_itens SET preco_unitario = preco_unitario - ? WHERE id = ?");

            foreach ($cart as $item) {
                $stmtItem->bind_param("iiid", $pedido_id, $item['id'], $item['qty'], $item['preco']);
                $stmtItem->execute();

                $stmtEst->bind_param("ii", $item['qty'], $item['id']);
                $stmtEst->execute();
            }

            $stmtItem->close();
            $stmtEst->close();

            $conexao->commit();
            unset($_SESSION['cart']);
            $cart = [];
            $total = 0.0;
            $mensagem = "Pedido finalizado com sucesso! ID: $pedido_id";
        } catch (Exception $e) {
            $conexao->rollback();
            $mensagem = "Erro ao finalizar pedido: " . $e->getMessage();
        }
    } else {
        $mensagem = "Preencha nome, email e tenha produtos no carrinho!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Carrinho de compras | Odisséia Literária</title>
    <link rel="stylesheet" href="estilos/style.css" media="all">
    <link rel="stylesheet" href="estilos/mobile.css" media="screen and (max-width: 600px)">
    <link rel="stylesheet" href="estilos/laptop.css" media="screen and (max-width: 1500px)">
    <link rel="stylesheet" href="estilos/laptop-1.css" media="screen and (max-width: 950px)">
    <link rel="stylesheet" href="estilos/tablet.css" media="screen and (max-width: 699px)">
    <link rel="stylesheet" href="estilos/mobile2.css" media="screen and (max-width: 500px)">
    <link rel="stylesheet" href="estilos/style002.css">

    <style>
        nav {
            padding: 0px 10px;
            flex-flow: row wrap;
            display: flex;
            gap: 10px;
        }

        nav>a {
            display: inline-block;
            flex: 0 1 68px;
            border: 1px solid;
            border-radius: 30px;
        }

        .hero {
            background-image: linear-gradient(to top, #1e3c72 0%, #1e3c72 1%, #2a5298 100%);
            color: #fff;
            display: grid;
            grid-template-rows: max-content 1fr;
            grid-template-areas:
                "nav"
                "content";
            min-height: 100vh;
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

        ::-webkit-scrollbar {
            width: 0px;
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

        #image {
            border: 10px solid white;
        }

        button {
            width: 400px;
            background-color: #440072;
            color: white;
            border: 0;
            padding: 15px;
            border-radius: 30px;
            cursor: pointer;
        }

        .finalizar-pattern {
            width: 700px;
            margin: auto;
            border: 1px solid rgba(168, 168, 168, 0.51);
            padding: 10px;
            border-radius: 20px;
            box-shadow: 0px 0px 10px rgba(252, 252, 252, 0.51);
            text-align: center;
        }

        td {
            border: 1px solid rgba(0, 0, 0, 0.222);
            padding: 15px 0px 15px 25px;
            border-top: none;
            border-right: none;
            border-left: none;
        }

        body {
            background-image: linear-gradient(to top, var(--roxo-profundo)60%, #440072);
            height: 190vh;
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

    <br><br><br><br>
    <div id="form" style="width: 1500px; margin: auto;">
        <h1>Carrinho de Compras</h1>
        <?php if (!empty($mensagem)): ?>
            <p><?= e($mensagem) ?></p>
        <?php endif; ?>
        <?php if (empty($cart)): ?>
            <p>O carrinho está vazio.</p>
        <?php else: ?>
            <form method="post">
                <table border="0" cellpadding="10">
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Subtotal</th>
                    </tr>
                    <?php foreach ($cart as $id => $item): ?>
                        <tr>
                            <td><?= e($item['nome']) ?></td>
                            <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
                            <td><input type="number" name="qty[<?= $id ?>]" value="<?= $item['qty'] ?>" min="1"></td>
                            <td>R$ <?= number_format($item['preco'] * $item['qty'], 2, ',', '.') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <button type="submit" name="update_cart" style="margin:auto">Atualizar quantidades</button>
                <br><br>
                <p style="font-weight: bold; font-size: 2em; text-decoration:underline">Total: R$
                    <?= number_format($total, 2, ',', '.') ?>
                </p>
                <br>
            </form>
            <br><br>
            <div class="finalizar-pattern">
                <h2>Finalizar Compra</h2>
                <br>
                <form method="post">
                    <label style="display: block;">Nome: <input type="text" name="cliente_nome" required></label><br><br>
                    <label style="display: block;">Email: <input type="email" name="cliente_email" required></label><br><br>
                    <button type="submit" name="finalizar">Finalizar Pedido</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Atualiza carrinho via AJAX
            $('form').on('submit', function (e) {
                if ($(this).find('button[name="update_cart"]').length) {
                    e.preventDefault();

                    $.ajax({
                        url: 'carrinho.php',
                        type: 'POST',
                        data: $(this).serialize(),
                        success: function (response) {
                            // Substitui apenas o conteúdo do carrinho
                            $('#form form').html(response);
                        },
                        error: function () {
                            alert('Erro ao atualizar o carrinho.');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
