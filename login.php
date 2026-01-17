<?php
session_start();

// Se já estiver logado, redireciona
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="../public/assets/css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../public/assets/css/auth.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(rgba(17, 24, 39, 0.7),
                    rgba(17, 24, 39, 0.7)), url('public/assets/img/agro.jpg') center/cover no-repeat;
            /* background-image: url("public/assets/img/green.jpg"); */
            background-size: cover;
            /* cobre toda a tela */
            background-position: center;
            /* centraliza a imagem */
            background-attachment: fixed;
            /* efeito parallax */
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.2);
            /* camada escura transparente */
            z-index: -1;
        }
    </style>

</head>

<body>


        <h2 class="text-white">Login</h2>

        <?php if (isset($_SESSION['erro'])): ?>
            <p style="color:red;"><?= $_SESSION['erro'] ?></p>
            <?php unset($_SESSION['erro']); ?>
        <?php endif; ?>

        <form method="post" action="views/auth/autenticar.php" class="auth-card">
            <label>Email</label><br>
            <input type="email" name="email" required><br><br>

            <label>Senha</label><br>
            <input type="password" name="senha" required><br><br>

            <button type="submit" class="btn sm">Entrar</button>
        </form>

</body>

</html>