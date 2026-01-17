<?php
$produtoId = (int)($_GET['produto_id'] ?? 0);
if (!$produtoId) exit('Produto inválido');
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Novo Lote</title>
    <link rel="stylesheet" href="/../public/assets/css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/../public/assets/css/form.css">
</head>

<body>

    <h2>Novo Lote</h2>

    <form method="post" action="salvar.php">

        <input type="hidden" name="produto_id" value="<?= $produtoId ?>">

        <label>Código do lote</label><br>
        <input type="text" name="codigo_lote" required><br><br>

        <label>Quantidade</label><br>
        <input type="number" step="0.01" name="quantidade" required><br><br>

        <label>Data produção</label><br>
        <input type="date" name="data_producao" required><br><br>

        <label>Data validade</label><br>
        <input type="date" name="data_validade"><br><br>

        <label>Local origem</label><br>
        <input type="text" name="local_origem"><br><br>

        <button type="submit">Salvar</button>
    </form>

    <a href="index.php?produto_id=<?= $produtoId ?>">Voltar</a>

</body>

</html>