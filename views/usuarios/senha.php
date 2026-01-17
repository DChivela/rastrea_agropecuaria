<?php
$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="/../public/assets/css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h2>Alterar Senha</h2>

<form method="post" action="senha_update.php?id=<?= $id ?>">
    <label>Nova senha</label><br>
    <input type="password" name="senha" required><br><br>
    <button type="submit">Atualizar</button>
</form>

<a href="index.php">Voltar</a>

</body>
</html>
