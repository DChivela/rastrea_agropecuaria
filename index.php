<?php
require_once 'auth.php';
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$pdo = require 'app/config/database.php';


// Busca produtos + produtor
$sql = "
SELECT 
    p.id,
    p.nome AS produto,
    p.tipo,
    p.unidade,
    pr.nome AS produtor
FROM produtos p
JOIN produtores pr ON pr.id = p.produtor_id
ORDER BY p.criado_em DESC
";

$stmt = $pdo->query($sql);
$produtos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Sistema de Rastreabilidade</title>
    <link rel="stylesheet" href="public/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background: linear-gradient(rgba(17, 24, 39, 0.7),
                    rgba(17, 24, 39, 0.7)), url('public/assets/img/green.jpg') center/cover no-repeat;
            /* background-image: url("public/assets/img/green.jpg"); */
            background-size: cover; /* cobre toda a tela */
            background-position: center; /* centraliza a imagem */
            background-attachment: fixed; /* efeito parallax */
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
            background: rgba(0, 0, 0, 0.2); /* camada escura transparente */
            z-index: -1;
        }
    </style>

</head>

<body>

    <header>
        <h1>Sistema de Rastreabilidade Agropecuária</h1>
        <nav>
            <a href="views/produtos/criar.php">Novo Produto</a>
            <!-- <a href="views/lotes/index.php">Lotes</a> Funcionam apenas com um ID associado -->
            <a href="views/produtores/index.php">Produtores</a>
            <a href="views/usuarios/index.php">Usuários</a>
            <a href="logout.php">Logout</a>
            <!-- <a href="views/eventos/index.php">Eventos Rastreio</a> Funcionam apenas com um ID associado -->
        </nav>
    </header>

    <main>
        <h2 class="text-white">Produtos Cadastrados</h2>

        <?php if (empty($produtos)): ?>
            <p>Nenhum produto registado.</p>
        <?php else: ?>
            <table class="table  align-middle bg-success">
                <thead class="table table-striped">
                    <tr class="table-active">
                        <th class="table-light">Produto</th>
                        <th>Tipo</th>
                        <th class="table-light">Produtor</th>
                        <th>Unidade</th>
                        <th class="table-light">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td class="table-light"><?= htmlspecialchars($p['produto']) ?></td>
                            <td><?= strtoupper($p['tipo']) ?></td>
                            <td class="table-light" ><?= htmlspecialchars($p['produtor']) ?></td>
                            <td><?= $p['unidade'] ?></td>
                            <td class="table-light">
                                <a href="../views/lotes/index.php?produto_id=<?= $p['id'] ?>" class="btn btn-secondary">Lotes</a> |
                                <a href="../views/produtos/editar.php?id=<?= $p['id'] ?>" class="btn btn-warning">Editar</a> |
                                <a href="../views/produtos/excluir.php?id=<?= $p['id'] ?>"
                                    onclick="return confirm('Excluir produto?')" class="btn btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <!-- <footer>
        <small>© < ?= date('Y') ?> - Sistema de Rastreabilidade</small>
    </footer> -->

</body>

</html>