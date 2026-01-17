<?php
$pdo = require '../../app/config/database.php';

$produtores = $pdo->query("SELECT id, nome FROM produtores")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Novo Produto</title>
</head>
<body>

<h2>Criar Produto</h2>

<form method="post" action="salvar.php">
    <label>Produtor</label><br>
    <select name="produtor_id" required>
        <option value="">-- selecione --</option>
        <?php foreach ($produtores as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome']) ?></option>
        <?php endforeach ?>
    </select><br><br>

    <label>Nome</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Tipo</label><br>
    <select name="tipo" required>
        <option value="carne">Carne</option>
        <option value="leite">Leite</option>
        <option value="graos">Grãos</option>
        <option value="outros">Outros</option>
    </select><br><br>

    <label>Descrição</label><br>
    <textarea name="descricao"></textarea><br><br>

    <label>Unidade</label><br>
    <input type="text" name="unidade" value="kg"><br><br>

    <button type="submit">Salvar</button>
</form>

<a href="/../index.php">Voltar</a>

</body>
</html>
