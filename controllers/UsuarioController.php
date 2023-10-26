<?php
include_once '../models/Usuario.php';

class UsuarioController {
  public function criar() {
    $usuario = new Usuario();
    // Lógica para criar um usuário
    // ...
    include_once '../views/usuario/criar.php';
  }

  public function listar() {
    $usuario = new Usuario();
    $usuarios = $usuario->listar();
    include_once '../views/usuario/listar.php';
  }

  // Outros métodos para editar, deletar, etc.
}
?>