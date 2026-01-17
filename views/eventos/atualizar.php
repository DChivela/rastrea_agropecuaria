<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Usuario.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Usuario($pdo);

$model->atualizar($id, [
    'nome_completo' => $_POST['nome_completo'],
    'email'         => $_POST['email'],
    'telefone'      => $_POST['telefone']
]);

header('Location: index.php');
exit;
