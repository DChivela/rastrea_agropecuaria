<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Lote.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Lote($pdo);

$model->atualizar($id, [
    'quantidade'    => $_POST['quantidade'],
    'data_validade' => $_POST['data_validade'],
    'status'        => $_POST['status'],
    'local_atual'   => $_POST['local_atual']
]);

header('Location: index.php');
exit;
