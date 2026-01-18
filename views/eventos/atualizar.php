<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/EventoRastreio.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new EventoRastreio($pdo);

$model->atualizar($id, [
    'tipo_evento' => $_POST['tipo_evento'],
    'descricao'   => $_POST['descricao'],
    'localizacao' => $_POST['localizacao'],
    'temperatura' => $_POST['temperatura'],
    'umidade'     => $_POST['umidade'],
    'responsavel' => $_POST['responsavel']
]);

header('Location: index.php');
exit;
