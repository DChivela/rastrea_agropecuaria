<?php

$pdo = require '../config/database.php';

$code = $_GET['code'] ?? null;
if (!$code) die('QR inválido');

$sql = "
SELECT l.*, p.nome AS produto, pr.nome AS produtor
FROM lotes l
JOIN produtos p ON p.id = l.produto_id
JOIN produtores pr ON pr.id = p.produtor_id
WHERE l.qr_codigo = ? AND l.qr_ativo = 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$code]);
$lote = $stmt->fetch();

if (!$lote) die('Lote não encontrado');
