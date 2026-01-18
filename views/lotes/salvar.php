<?php

$pdo = require '../../app/config/database.php';
require '../../lib/qr.php';

// dados do formulário
$produto_id    = $_POST['produto_id'];
$codigo_lote   = $_POST['codigo_lote'];
$quantidade    = $_POST['quantidade'];
$data_producao = $_POST['data_producao'];
$data_validade = $_POST['data_validade'] ?? null;
$local_origem  = $_POST['local_origem'] ?? null;

// gera código único do QR (1 POR LOTE)
$qr_codigo = bin2hex(random_bytes(10));

// grava lote
$sql = "INSERT INTO lotes (
    produto_id,
    codigo_lote,
    quantidade,
    data_producao,
    data_validade,
    status,
    local_origem,
    local_atual,
    qr_codigo
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $produto_id,
    $codigo_lote,
    $quantidade,
    $data_producao,
    $data_validade,
    'em_producao',
    $local_origem,
    $local_origem,
    $qr_codigo
]);

/* === GERA QR CORRETAMENTE === */

// URL pública que o consumidor vai abrir
$url = "http://localhost:3000/public/lote.php?code=" . $qr_codigo;

// caminho REAL no disco
$qrPath = __DIR__ . '/../../public/qrcodes/' . $qr_codigo . '.png';

// gera imagem PNG válida
gerarQRCode($url, $qrPath);

// redireciona corretamente
header('Location: /../index.php');
exit;
