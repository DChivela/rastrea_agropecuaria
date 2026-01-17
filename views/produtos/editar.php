<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produto.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Produto($pdo);
$produto = $model->buscar($id);

$produtores = $pdo->query("SELECT id, nome FROM produtores")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="/../public/assets/css/form.css">
</head>

<body>

    <h2>Editar Produto</h2>

    <form method="post" action="atualizar.php?id=<?= $id ?>">
        <label>Produtor</label><br>
        <select name="produtor_id">
            <?php foreach ($produtores as $p): ?>
                <option value="<?= $p['id'] ?>"
                    <?= $p['id'] == $produto['produtor_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($p['nome']) ?>
                </option>
            <?php endforeach ?>
        </select><br><br>

        <label>Nome</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>"><br><br>

        <label>Tipo</label><br>
        <select name="tipo">
            <?php foreach (['carne', 'leite', 'graos', 'outros'] as $t): ?>
                <option value="<?= $t ?>" <?= $produto['tipo'] === $t ? 'selected' : '' ?>>
                    <?= ucfirst($t) ?>
                </option>
            <?php endforeach ?>
        </select><br><br>

        <label>Descrição</label><br>
        <textarea name="descricao"><?= htmlspecialchars($produto['descricao']) ?></textarea><br><br>

        <label>Unidade</label><br>
        <input type="text" name="unidade" value="<?= $produto['unidade'] ?>"><br><br>

        <button type="submit">Atualizar</button>
    </form>

    <a href="/../index.php">Voltar</a>

</body>

</html>