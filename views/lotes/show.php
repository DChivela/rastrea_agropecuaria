<?php
$pdo = require '../../app/config/database.php';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    exit('Lote inválido');
}

/* === BUSCA LOTE === */
$sql = "
SELECT l.*, p.nome AS produto_nome
FROM lotes l
JOIN produtos p ON p.id = l.produto_id
WHERE l.id = ?
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$lote = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$lote) {
    exit('Lote não encontrado');
}

/* === BUSCA EVENTOS === */
$sql = "
SELECT *
FROM eventos_rastreio
WHERE lote_id = ?
ORDER BY data_evento ASC
";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lote <?= htmlspecialchars($lote['codigo_lote']) ?></title>
    <style>
        body {
            font-family: Arial
        }

        .container {
            max-width: 1000px;
            margin: auto
        }

        .flex {
            display: flex;
            gap: 40px
        }

        .qr img {
            border: 1px solid #ccc;
            padding: 10px;
            background: #fff
        }

        .timeline {
            margin-top: 30px
        }

        .evento {
            border-left: 3px solid #2c7;
            padding-left: 15px;
            margin-bottom: 15px
        }

        .tipo {
            font-weight: bold;
            text-transform: capitalize
        }

        .data {
            font-size: 12px;
            color: #666
        }
    </style>
</head>

<body>
    <div class="container">

        <h1>Lote <?= htmlspecialchars($lote['codigo_lote']) ?></h1>

        <div class="flex">
            <div>
                <p><strong>Produto:</strong> <?= htmlspecialchars($lote['produto_nome']) ?></p>
                <p><strong>Quantidade:</strong> <?= $lote['quantidade'] ?></p>
                <p><strong>Status:</strong> <?= $lote['status'] ?></p>
                <p><strong>Origem:</strong> <?= $lote['local_origem'] ?></p>
                <p><strong>Local atual:</strong> <?= $lote['local_atual'] ?></p>
                <p><strong>Produção:</strong> <?= $lote['data_producao'] ?></p>
                <p><strong>Validade:</strong> <?= $lote['data_validade'] ?? '-' ?></p>
            </div>

            <div class="qr">
                <img src="/public/qrcodes/<?= $lote['qr_codigo'] ?>.png" width="200">
                <p style="text-align:center">QR Code</p>
            </div>
        </div>

        <div class="timeline">
            <h2>Histórico de Rastreabilidade</h2>

            <?php if (empty($eventos)): ?>
                <p>Nenhum evento registado.</p>
            <?php endif; ?>

            <?php foreach ($eventos as $e): ?>
                <div class="evento">
                    <div class="tipo"><?= $e['tipo_evento'] ?></div>
                    <div class="data"><?= $e['data_evento'] ?></div>
                    <div><?= htmlspecialchars($e['descricao']) ?></div>
                    <small>
                        <?= $e['localizacao'] ?>
                        <?= $e['temperatura'] ? '| Temp: ' . $e['temperatura'] . '°C' : '' ?>
                        <?= $e['umidade'] ? '| Umid: ' . $e['umidade'] . '%' : '' ?>
                    </small>
                </div>
            <?php endforeach; ?>
        </div>
        <a href="/../index.php">Voltar</a>
    </div>
</body>

</html>