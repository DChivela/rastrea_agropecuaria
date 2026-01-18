<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Lote.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Lote($pdo);

$model->excluir($id);

header('Location: /../index.php');
exit;
