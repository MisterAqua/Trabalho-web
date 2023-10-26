<?php
include_once 'db.php';

class Usuario {
  public $id;
  public $nome;
  public $email;

  public function criar() {
    global $conn;
    // Código para inserir um usuário no banco de dados
  }

  public function listar() {
    global $conn;
    // Código para buscar usuários do banco de dados
  }

  // Outros métodos para atualizar, deletar, etc.
}
?>