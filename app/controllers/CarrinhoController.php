<?php
include_once '../models/Carrinho.php';

class CarrinhoController {

  public function adicionarProduto($id_venda, $id_produto) {
    $carrinho = new Carrinho();
    $carrinho->id_venda = $id_venda;
    $carrinho->id_produto = $id_produto;

    if ($carrinho->criar()) {
      return $carrinho;
    } else {
      return false;
    }
  }

  public function listarProdutos($id_venda) {
    $carrinho = new Carrinho();
    return $carrinho->listarPorVenda($id_venda);
  }

  public function removerProduto($id) {
    $carrinho = Carrinho::buscarPorId($id);

    if ($carrinho && $carrinho->deletar()) {
      return true;
    }
    return false;
  }
}
?>
