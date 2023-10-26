<?php
include_once 'C:\xampp\htdocs\Trabalho-web\config\db.php';

class Venda {
  public $id;
  public $valor_total;
  public $id_cliente;

  public function criar() {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO venda (id, valor_total, id_cliente) VALUES (retornaIDMAX(), ?, ?)");
    $stmt->bind_param("di", $this->valor_total, $this->id_cliente);
    
    if ($stmt->execute()) {
      $this->id = $conn->insert_id; // Armazena o último ID inserido
      return true;
    } else {
      return false;
    }
  }

  public function listar() {
    global $conn;
    $result = $conn->query("SELECT id, valor_total, id_cliente FROM venda");
    $vendas = [];

    while($row = $result->fetch_assoc()) {
      $venda = new Venda();
      $venda->id = $row["id"];
      $venda->valor_total = $row["valor_total"];
      $venda->id_cliente = $row["id_cliente"];
      $vendas[] = $venda;
    }

    return $vendas;
  }

  public function atualizar() {
    global $conn;
    $stmt = $conn->prepare("UPDATE venda SET valor_total = ?, id_cliente = ? WHERE id = ?");
    $stmt->bind_param("dii", $this->valor_total, $this->id_cliente, $this->id);
    
    return $stmt->execute();
  }

  public function deletar() {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM venda WHERE id = ?");
    $stmt->bind_param("i", $this->id);
    
    return $stmt->execute();
  }

  public static function buscarPorId($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM venda WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) return null;

    $row = $result->fetch_assoc();
    $venda = new Venda();
    $venda->id = $row["id"];
    $venda->valor_total = $row["valor_total"];
    $venda->id_cliente = $row["id_cliente"];

    return $venda;
  }
}
?>