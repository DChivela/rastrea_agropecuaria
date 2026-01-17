<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Novo Utilizador</title>
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

<a href="../../public/index.php">Voltar</a>

</body>
</html>
