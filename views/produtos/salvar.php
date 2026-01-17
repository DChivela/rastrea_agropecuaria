<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Produto.php';

$produto = new Produto($pdo);

$produto->criar([
    'produtor_id' => $_POST['produtor_id'],
    'nome'        => $_POST['nome'],
    'tipo'        => $_POST['tipo'],
    'descricao'   => $_POST['descricao'],
    'unidade'     => $_POST['unidade']
]);

header('Location: /../index.php');
exit;
