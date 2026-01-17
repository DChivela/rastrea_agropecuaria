<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Lote.php';
require '../../app/models/QrCode.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pdo->beginTransaction();

    try {
        $loteModel = new Lote($pdo);
        $loteModel->criar($_POST);

        $loteId = $pdo->lastInsertId();

        $qrCode = new QrCode($pdo);
        $qrCode->gerar($loteId);

        $pdo->commit();
        header('Location: index.php');
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        die('Erro: ' . $e->getMessage());
    }
}
