<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/EventoRastreio.php';

$model = new EventoRastreio($pdo);

$model->criar([
    'lote_id'      => $_POST['lote_id'],
    'tipo_evento'  => $_POST['tipo_evento'],
    'descricao'    => $_POST['descricao'],
    'localizacao'  => $_POST['localizacao'],
    'temperatura'  => $_POST['temperatura'],
    'umidade'      => $_POST['umidade'],
    'responsavel'  => $_POST['responsavel']
]);

header('Location: index.php?lote_id=' . $_POST['lote_id']);
exit;
