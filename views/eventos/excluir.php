<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/EventoRastreio.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new EventoRastreio($pdo);

$model->excluir($id);

header('Location: index.php');
exit;
