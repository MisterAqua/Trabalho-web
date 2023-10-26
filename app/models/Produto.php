<?php
require_once '../config/db.php';

class Produto {
  public $id;
  public $descricao;
  public $nome;
  public $preco;
  public $url;

  public function criar() {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO produto (descricao, nome, preco, url) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $this->descricao, $this->nome, $this->preco, $this->url);
    
    if ($stmt->execute()) {
      $this->id = $conn->insert_id;
      return true;
    } else {
      return false;
    }
  }

  public function listar() {
    global $conn;
    $result = $conn->query("SELECT id, descricao, nome, preco, url FROM produto");
    $produtos = [];

    while($row = $result->fetch_assoc()) {
      $produto = new Produto();
      $produto->id = $row["id"];
      $produto->descricao = $row["descricao"];
      $produto->nome = $row["nome"];
      $produto->preco = $row["preco"];
      $produto->url = $row["url"];
      $produtos[] = $produto;
    }

    return $produtos;
  }

  public function atualizar() {
    global $conn;
    $stmt = $conn->prepare("UPDATE produto SET descricao = ?, nome = ?, preco = ?, url = ? WHERE id = ?");
    $stmt->bind_param("ssdsi", $this->descricao, $this->nome, $this->preco, $this->url, $this->id);
    
    return $stmt->execute();
  }

  public function deletar() {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM produto WHERE id = ?");
    $stmt->bind_param("i", $this->id);
    
    return $stmt->execute();
  }

  public static function buscarPorId($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM produto WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) return null;

    $row = $result->fetch_assoc();
    $produto = new Produto();
    $produto->id = $row["id"];
    $produto->descricao = $row["descricao"];
    $produto->nome = $row["nome"];
    $produto->preco = $row["preco"];
    $produto->url = $row["url"];

    return $produto;
  }
}
?>