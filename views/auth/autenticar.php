<?php
session_start();
$pdo = require '../../app/config/database.php';

// Recebe dados
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$stmt = $pdo->prepare("SELECT id, nome_completo, senha FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$usuario = $stmt->fetch();

if ($usuario && password_verify($senha, $usuario['senha'])) {
    // Login válido
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome_completo'];
    header("Location: /../index.php");
    exit;
} else {
    // Falha
    $_SESSION['erro'] = "Email ou senha inválidos!";
    header("Location: login.php");
    exit;
}
