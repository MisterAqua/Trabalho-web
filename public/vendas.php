<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main-container">
        <h1>Página de Vendas</h1>
        <p>Aqui você pode adicionar produtos à sua venda.</p>

        <?php
        session_start();
        include_once '../app/controllers/VendaController.php';
        include_once '../app/controllers/ProdutoController.php';

        if (!isset($_SESSION['id_venda'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
                $vendaController = new VendaController();
                $venda = $vendaController->criar($_POST['id_cliente'], 0);

                if ($venda) {
                    $_SESSION['id_venda'] = $venda->id;
                } else {
                    echo "<p>Erro ao criar venda.</p>";
                }
            } else {
                ?>
                <section>
                    <h2>Iniciar Venda</h2>
                    <form method="post" action="">
                        <label for="id_cliente">ID do Cliente:</label>
                        <input type="number" id="id_cliente" name="id_cliente" required><br>
                        <button type="submit">Iniciar Venda</button>
                    </form>
                </section>
                <?php
                exit;
            }
        }

        $produtoController = new ProdutoController();
        $produtos = $produtoController->listar();
        ?>

        <section>
            <h2>Adicionar Produtos à Venda</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>URL</th>
                    <th>Ação</th>
                </tr>
                <?php
                foreach ($produtos as $produto) {
                    echo "<tr>";
                    echo "<td>" . $produto->id . "</td>";
                    echo "<td>" . $produto->descricao . "</td>";
                    echo "<td>" . $produto->nome . "</td>";
                    echo "<td>R$ " . number_format($produto->preco, 2, ',', '.') . "</td>";
                    echo "<td><a href='" . $produto->url . "'>Link</a></td>";
                    echo "<td>
                            <button onclick='adicionarAoCarrinho(" . $produto->id . ")'>Adicionar</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </section>

        <script>
            function adicionarAoCarrinho(idProduto) {
                // Código para adicionar o produto ao carrinho
                // Pode ser uma chamada AJAX para um endpoint que manipula o carrinho
            }
        </script>
    </div>
</body>
</html>