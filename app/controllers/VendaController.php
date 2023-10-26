<?php
include_once 'Venda.php';

class VendaController {

  public function criar($valor_total, $id_cliente) {
    $venda = new Venda();
    $venda->valor_total = $valor_total;
    $venda->id_cliente = $id_cliente;

    if ($venda->criar()) {
      return $venda;
    } else {
      return false;
    }
  }

  public function listar() {
    $venda = new Venda();
    return $venda->listar();
  }

  public function buscarPorId($id) {
    return Venda::buscarPorId($id);
  }

  public function atualizar($id, $valor_total, $id_cliente) {
    $venda = Venda::buscarPorId($id);

    if ($venda) {
      $venda->valor_total = $valor_total;
      $venda->id_cliente = $id_cliente;

      if ($venda->atualizar()) {
        return $venda;
      }
    }
    return false;
  }

  public function deletar($id) {
    $venda = Venda::buscarPorId($id);

    if ($venda && $venda->deletar()) {
      return true;
    }
    return false;
  }
}
?>
