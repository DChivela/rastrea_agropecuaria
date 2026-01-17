<?php
$pdo = require '../../app/config/database.php';
require '../../app/models/Usuario.php';

$id = (int)($_GET['id'] ?? 0);
if (!$id) exit('ID inválido');

$model = new Usuario($pdo);
$model->atualizarSenha($id, password_hash($_POST['senha'], PASSWORD_DEFAULT));

header('Location: index.php');
exit;
