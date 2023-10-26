<?php
require_once '../config/db.php';

class Carrinho {
  public $id;
  public $id_venda;
  public $id_produto;

  public function criar() {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO carrinho (id_venda, id_produto) VALUES (?, ?)");
    $stmt->bind_param("ii", $this->id_venda, $this->id_produto);
    
    if ($stmt->execute()) {
      $this->id = $conn->insert_id;
      return true;
    } else {
      return false;
    }
  }

  public function listar() {
    global $conn;
    $result = $conn->query("SELECT id, id_venda, id_produto FROM carrinho");
    $itensCarrinho = [];

    while($row = $result->fetch_assoc()) {
      $itemCarrinho = new Carrinho();
      $itemCarrinho->id = $row["id"];
      $itemCarrinho->id_venda = $row["id_venda"];
      $itemCarrinho->id_produto = $row["id_produto"];
      $itensCarrinho[] = $itemCarrinho;
    }

    return $itensCarrinho;
  }

  public function listarPorVenda($id_venda) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM carrinho WHERE id_venda = ?");
    $stmt->bind_param("i", $id_venda);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $itensDoCarrinho = [];
    while ($row = $result->fetch_assoc()) {
      $carrinho = new Carrinho();
      $carrinho->id = $row['id'];
      $carrinho->id_venda = $row['id_venda'];
      $carrinho->id_produto = $row['id_produto'];
      $itensDoCarrinho[] = $carrinho;
    }
    
    return $itensDoCarrinho;
  }

  public function atualizar() {
    global $conn;
    $stmt = $conn->prepare("UPDATE carrinho SET id_venda = ?, id_produto = ? WHERE id = ?");
    $stmt->bind_param("iii", $this->id_venda, $this->id_produto, $this->id);
    
    return $stmt->execute();
  }

  public function deletar() {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM carrinho WHERE id = ?");
    $stmt->bind_param("i", $this->id);
    
    return $stmt->execute();
  }

  public static function buscarPorId($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM carrinho WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) return null;

    $row = $result->fetch_assoc();
    $itemCarrinho = new Carrinho();
    $itemCarrinho->id = $row["id"];
    $itemCarrinho->id_venda = $row["id_venda"];
    $itemCarrinho->id_produto = $row["id_produto"];

    return $itemCarrinho;
  }
}
?>