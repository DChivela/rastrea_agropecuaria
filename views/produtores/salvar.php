<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produtor.php';

$model = new Produtor($pdo);

$model->criar([
    'usuario_id'   => $_POST['usuario_id'],
    'nome'         => $_POST['nome'],
    'bi'         => $_POST['bi'],
    'endereco'     => $_POST['endereco'],
    'cidade'       => $_POST['cidade'],
    'provincia'       => $_POST['provincia'],
    'latitude'     => $_POST['latitude'],
    'longitude'    => $_POST['longitude'],
    'certificacao' => $_POST['certificacao']
]);

header('Location: index.php');
exit;
