<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Novo Utilizador</title>
    <link rel="stylesheet" href="/../public/assets/css/form.css">
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/../public/assets/css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>

<body>

    <h2>Novo Utilizador</h2>

    <form method="post" action="salvar.php">

        <label>Nome completo</label><br>
        <input type="text" name="nome_completo" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telefone</label><br>
        <input type="text" name="telefone"><br><br>

        <label>Senha</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Salvar</button>
    </form>

    <a href="/../index.php">Voltar</a>

</body>

</html>