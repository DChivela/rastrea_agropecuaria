<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Lote.php';

$produtoId = (int)($_GET['produto_id'] ?? 0);
if (!$produtoId) exit('Produto inválido');

$model = new Lote($pdo);
$lotes = $model->listarPorProduto($produtoId);
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lotes</title>
    <link rel="stylesheet" href="/../public/assets/css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <h2>Lotes do Produto</h2>

    <a href="criar.php?produto_id=<?= $produtoId ?>">Novo Lote</a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Código</th>
            <th>Quantidade</th>
            <th>Status</th>
            <th>Produção</th>
            <th>QR Code</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($lotes as $l): ?>
            <tr>
                <td><?= $l['codigo_lote'] ?></td>
                <td><?= $l['quantidade'] ?></td>
                <td><?= $l['status'] ?></td>
                <td><?= $l['data_producao'] ?></td>
                <td><img src="/../../public/qrcodes/<?= $produtoId ?>.png" alt="QR Code do Produto"></td>

                <td>
                    <a href="../eventos/index.php?lote_id=<?= $l['id'] ?>">Eventos</a> |
                    <a href="editar.php?id=<?= $l['id'] ?>">Editar</a> |
                    <a href="show.php?id=<?= $l['id'] ?>">Visualizar</a>
                    <a href="excluir.php?id=<?= $l['id'] ?>" onclick="return confirm('Excluir lote?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <a href="/../index.php">Voltar</a>

</body>

</html>