<?php
include_once '../../config/db.php';

class Usuario {
  public $id;
  public $nome;
  public $email;
  public $senha;

  public function criar() {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $this->nome, $this->email, $this->senha);
    
    if ($stmt->execute()) {
      $this->id = $conn->insert_id;
      return true;
    } else {
      return false;
    }
  }

  public function listar() {
    global $conn;
    $result = $conn->query("SELECT id, nome, email, senha FROM usuarios");
    $usuarios = [];

    while($row = $result->fetch_assoc()) {
      $usuario = new Usuario();
      $usuario->id = $row["id"];
      $usuario->nome = $row["nome"];
      $usuario->email = $row["email"];
      $usuario->senha = $row["senha"];
      $usuarios[] = $usuario;
    }

    return $usuarios;
  }

  public function atualizar() {
    global $conn;
    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ? WHERE id = ?");
    $stmt->bind_param("sssi", $this->nome, $this->email, $this->senha, $this->id);
    
    return $stmt->execute();
  }

  public function deletar($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $this->$id);
    
    return $stmt->execute();
  }

  public static function buscarPorId($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) return null;

    $row = $result->fetch_assoc();
    $usuario = new Usuario();
    $usuario->id = $row["id"];
    $usuario->nome = $row["nome"];
    $usuario->email = $row["email"];
    $usuario->senha = $row["senha"];

    return $usuario;
  }

  public function buscarPorEmail($email) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
      $resultado = $stmt->get_result();
      $usuario = $resultado->fetch_object();

      // Retorna um objeto usuário ou null se não encontrado
      return $usuario;
    } else {
      // Log ou trate o erro conforme necessário
      return null;
    }
  }
}
?>