<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produto.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Produto($pdo);
$model->excluir($id);

header('Location: ../../public/index.php');
exit;
