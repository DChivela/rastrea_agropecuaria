<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Usuario.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Usuario($pdo);
$usuario = $model->buscar($id);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Editar Utilizador</title>
    <link rel="stylesheet" href="/../public/assets/css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h2>Editar Utilizador</h2>

<form method="post" action="atualizar.php?id=<?= $id ?>">

    <label>Nome completo</label><br>
    <input type="text" name="nome_completo" value="<?= htmlspecialchars($usuario['nome_completo']) ?>"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>"><br><br>

    <label>Telefone</label><br>
    <input type="text" name="telefone" value="<?= $usuario['telefone'] ?>"><br><br>

    <button type="submit">Atualizar</button>
</form>

<a href="index.php">Voltar</a>

</body>
</html>
