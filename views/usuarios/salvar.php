<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Usuario.php';

$model = new Usuario($pdo);

$model->criar([
    'nome_completo' => $_POST['nome_completo'],
    'email'         => $_POST['email'],
    'telefone'      => $_POST['telefone'],
    'senha'         => password_hash($_POST['senha'], PASSWORD_DEFAULT)
]);

header('Location: index.php');
exit;
