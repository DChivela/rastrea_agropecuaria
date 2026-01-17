<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produtor.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Produtor($pdo);
$produtor = $model->buscar($id);

$usuarios = $pdo->query("SELECT id, nome_completo FROM usuarios")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Produtor</title>
    <link rel="stylesheet" href="/../public/assets/css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS --> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<h2>Editar Produtor</h2>

<form method="post" action="atualizar.php?id=<?= $id ?>">

    <label>Usuário</label><br>
    <select name="usuario_id">
        <?php foreach ($usuarios as $u): ?>
            <option value="<?= $u['id'] ?>"
                <?= $u['id'] == $produtor['usuario_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($u['nome_completo']) ?>
            </option>
        <?php endforeach ?>
    </select><br><br>

    <label>Nome</label><br>
    <input type="text" name="nome" value="<?= htmlspecialchars($produtor['nome']) ?>"><br><br>

    <label>BI</label><br>
    <input type="text" name="bi" value="<?= $produtor['bi'] ?>"><br><br>

    <label>Endereço</label><br>
    <textarea name="endereco"><?= htmlspecialchars($produtor['endereco']) ?></textarea><br><br>

    <label>Cidade</label><br>
    <input type="text" name="cidade" value="<?= $produtor['cidade'] ?>"><br><br>

    <label>Província</label><br>
    <input type="text" name="provincia" value="<?= $produtor['provincia'] ?>"><br><br>

    <label>Latitude</label><br>
    <input type="text" name="latitude" value="<?= $produtor['latitude'] ?>"><br><br>

    <label>Longitude</label><br>
    <input type="text" name="longitude" value="<?= $produtor['longitude'] ?>"><br><br>

    <label>Certificação</label><br>
    <input type="text" name="certificacao" value="<?= $produtor['certificacao'] ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>

<a href="index.php">Voltar</a>

</body>
</html>
