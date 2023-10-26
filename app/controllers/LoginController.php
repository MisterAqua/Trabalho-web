<?php
session_start();
include_once '../config/db.php';
include_once '../Controllers/UsuarioController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? null;
  $senha = $_POST['password'] ?? null;

  if ($email && $senha) {
    $usuarioController = new UsuarioController();
    $usuarioController->login($email, $senha);
  } else {
    header('Location: /caminho/para/sua/pagina/de/login?erro=2');
    exit;
  }
}
?>
