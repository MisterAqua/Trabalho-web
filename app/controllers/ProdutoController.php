<?php
include_once '../app/models/Produto.php';

class ProdutoController {

  public function criar($descricao, $nome, $preco, $url) {
    $produto = new Produto();
    $produto->descricao = $descricao;
    $produto->nome = $nome;
    $produto->preco = $preco;
    $produto->url = $url;

    if ($produto->criar()) {
      return $produto;
    } else {
      return false;
    }
  }

  public function listar() {
    $produto = new Produto();
    return $produto->listar();
  }

  public function buscarPorId($id) {
    return Produto::buscarPorId($id);
  }

  public function atualizar($id, $descricao, $nome, $preco, $url) {
    $produto = Produto::buscarPorId($id);

    if ($produto) {
      $produto->descricao = $descricao;
      $produto->nome = $nome;
      $produto->preco = $preco;
      $produto->url = $url;

      if ($produto->atualizar()) {
        return $produto;
      }
    }
    return false;
  }

  public function deletar($id) {
    $produto = Produto::buscarPorId($id);

    if ($produto && $produto->deletar()) {
      return true;
    }
    return false;
  }
}
?>