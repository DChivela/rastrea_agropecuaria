<?php
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
</head>

<body>

    <header>
        <h1>Sistema de Rastreabilidade Agropecuária</h1>
        <nav>
            <a href="views/produtos/criar.php">Novo Produto</a>
            <a href="views/lotes/index.php">Lotes</a>
            <a href="views/produtores/index.php">Produtores</a>
            <a href="views/usuarios/index.php">Usuários</a>
            <a href="views/eventos/index.php">Eventos Rastreio</a>
        </nav>
    </header>

    <main>
        <h2>Produtos Cadastrados</h2>

        <?php if (empty($produtos)): ?>
            <p>Nenhum produto registado.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Tipo</th>
                        <th>Produtor</th>
                        <th>Unidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['produto']) ?></td>
                            <td><?= strtoupper($p['tipo']) ?></td>
                            <td><?= htmlspecialchars($p['produtor']) ?></td>
                            <td><?= $p['unidade'] ?></td>

                            <td>
                                <a href="../views/lotes/index.php?produto_id=<?= $p['id'] ?>">Lotes</a> |
                                <a href="../views/produtos/editar.php?id=<?= $p['id'] ?>">Editar</a> |
                                <a href="../views/produtos/excluir.php?id=<?= $p['id'] ?>"
                                    onclick="return confirm('Excluir produto?')">Excluir</a>
                            </td>

                            <td>
                                <a href="../views/lotes/index.php?produto_id=<?= $p['id'] ?>">
                                    Ver Lotes
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <small>© <?= date('Y') ?> - Sistema de Rastreabilidade</small>
    </footer>

</body>

</html>