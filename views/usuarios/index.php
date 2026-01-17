<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Usuario.php';

$model = new Usuario($pdo);
$usuarios = $model->listar();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Utilizadores</title>
    <link rel="stylesheet" href="/../public/assets/css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>

    <h2>Utilizadores</h2>

    <a href="criar.php">Novo Utilizador</a><br><br>

    <table class="table table-bordered table-striped align-middle" cellpadding="8">
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Criado em</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['nome_completo']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><?= $u['telefone'] ?></td>
                <td><?= date('d/m/Y', strtotime($u['criado_em'])) ?></td>
                <td>
                    <a href="editar.php?id=<?= $u['id'] ?>" class="btn btn-warning">Editar</a> |
                    <a href="senha.php?id=<?= $u['id'] ?>" class="btn btn-primary">Senha</a> |
                    <a href="excluir.php?id=<?= $u['id'] ?>"
                        onclick="return confirm('Excluir utilizador?')" class="btn btn-danger">Excluir</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>

    <a href="/../index.php">Voltar</a>

</body>

</html>