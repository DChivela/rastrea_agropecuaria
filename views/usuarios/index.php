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
</head>
<body>

<h2>Utilizadores</h2>

<a href="criar.php">Novo Utilizador</a><br><br>

<table border="1" cellpadding="8">
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
                <a href="editar.php?id=<?= $u['id'] ?>">Editar</a> |
                <a href="senha.php?id=<?= $u['id'] ?>">Senha</a> |
                <a href="excluir.php?id=<?= $u['id'] ?>"
                   onclick="return confirm('Excluir utilizador?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<a href="/../index.php">Voltar</a>

</body>
</html>
