<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Lote.php';

$model = new Lote($pdo);

$model->criar([
    'produto_id'     => $_POST['produto_id'],
    'codigo_lote'    => $_POST['codigo_lote'],
    'quantidade'     => $_POST['quantidade'],
    'data_producao'  => $_POST['data_producao'],
    'data_validade'  => $_POST['data_validade'],
    'local_origem'   => $_POST['local_origem']
]);

header('Location: index.php?produto_id=' . $_POST['produto_id']);
exit;
