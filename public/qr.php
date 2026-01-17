<?php
$pdo = require '../app/config/database.php';

$codigo = $_GET['c'] ?? null;
if (!$codigo) exit('QR inválido');

$sql = "
SELECT l.*, p.nome AS produto, pr.nome AS produtor
FROM qr_codes q
JOIN lotes l ON l.id = q.lote_id
JOIN produtos p ON p.id = l.produto_id
JOIN produtores pr ON pr.id = p.produtor_id
WHERE q.codigo = ? AND q.ativo = 1
";

$stmt = $pdo->prepare($sql);
$stmt->execute([$codigo]);
$dado = $stmt->fetch();

if (!$dado) exit('Registro não encontrado');

// contabiliza leitura
$pdo->prepare("
    UPDATE qr_codes 
    SET contador_escaneamentos = contador_escaneamentos + 1,
        ultimo_escaneamento = NOW()
    WHERE codigo = ?
")->execute([$codigo]);

