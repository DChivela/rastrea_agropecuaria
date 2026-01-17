<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produto.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Produto($pdo);

$model->atualizar($id, [
    'produtor_id' => $_POST['produtor_id'],
    'nome'        => $_POST['nome'],
    'tipo'        => $_POST['tipo'],
    'descricao'   => $_POST['descricao'],
    'unidade'     => $_POST['unidade']
]);

header('Location: /../index.php');
exit;
