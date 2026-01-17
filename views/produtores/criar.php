<?php
$pdo = require '../../app/config/database.php';
$usuarios = $pdo->query("SELECT id, nome_completo FROM usuarios")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Novo Produtor</title>
</head>
<body>

<h2>Novo Produtor</h2>

<form method="post" action="salvar.php">

    <label>Usuário</label><br>
    <select name="usuario_id" required>
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nome_completo']) ?></option>
        <?php endforeach ?>
    </select><br><br>

    <label>Nome</label><br>
    <input type="text" name="nome" required><br><br>

    <label>BI</label><br>
    <input type="text" name="bi"><br><br>

    <label>Endereço</label><br>
    <textarea name="endereco"></textarea><br><br>

    <label>Cidade</label><br>
    <input type="text" name="cidade"><br><br>

    <label>Província</label><br>
    <input type="text" name="provincia"><br><br>

    <label>Latitude</label><br>
    <input type="text" name="latitude"><br><br>

    <label>Longitude</label><br>
    <input type="text" name="longitude"><br><br>

    <label>Certificação</label><br>
    <input type="text" name="certificacao"><br><br>

    <button type="submit">Salvar</button>
</form>

<a href="index.php">Voltar</a>

</body>
</html>
