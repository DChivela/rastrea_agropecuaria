<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produtor.php';

$model = new Produtor($pdo);
$produtores = $model->listar();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Produtores</title>
    <link rel="stylesheet" href="/../public/assets/css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <h2>Produtores</h2>

    <a href="criar.php">Novo Produtor</a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Nome</th>
            <th>BI</th>
            <th>Cidade</th>
            <th>Província</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtores as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['nome']) ?></td>
                <td><?= $p['bi'] ?></td>
                <td><?= $p['cidade'] ?></td>
                <td><?= $p['provincia'] ?></td>
                <td>
                    <a href="editar.php?id=<?= $p['id'] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $p['id'] ?>"
                        onclick="return confirm('Excluir produtor?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <a href="/../index.php">Voltar</a>

</body>

</html>