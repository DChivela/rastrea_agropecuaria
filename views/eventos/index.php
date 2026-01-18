<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/EventoRastreio.php';

$loteId = (int)($_GET['lote_id'] ?? 0);
if (!$loteId) exit('Lote inválido');

$model = new EventoRastreio($pdo);
$eventos = $model->listarPorLote($loteId);
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Eventos</title>
    <link rel="stylesheet" href="/../public/assets/css/table.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>

    <h2>Eventos de Rastreio</h2>

    <a href="criar.php?lote_id=<?= $loteId ?>">Novo Evento</a><br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Local</th>
            <th>Data</th>
        </tr>
        <?php foreach ($eventos as $e): ?>
            <tr>
                <td><?= $e['tipo_evento'] ?></td>
                <td><?= $e['descricao'] ?></td>
                <td><?= $e['localizacao'] ?></td>
                <td><?= $e['data_evento'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>

    <a href="../lotes/index.php?produto_id=<?= $loteId ?>">Voltar</a>

</body>

</html>