<?php
include_once '../models/Usuario.php';

class UsuarioController {
  public function criar($dados) {
    $usuario = new Usuario();
    
    // Sanitizar e validar os dados aqui
    $nome = $dados['nome'] ?? '';
    $email = $dados['email'] ?? '';
    $senha = $dados['senha'] ?? '';

    if ($nome && $email && $senha) {
      $usuario->nome = $nome;
      $usuario->email = $email;
      $usuario->senha = password_hash($senha, PASSWORD_DEFAULT);

      if ($usuario->criar()) {
        header('Location: /caminho/para/lista/de/usuarios');
      } else {
        header('Location: /caminho/para/formulario/de/criacao?erro=1');
      }
    } else {
      header('Location: /caminho/para/formulario/de/criacao?erro=2');
    }
    exit;
  }

  public function listar() {
    $usuario = new Usuario();
    $usuarios = $usuario->listar();
    include_once '../views/usuario/listar.php';
  }

  public function editar($id, $dados) {
    $usuario = new Usuario();
    $usuarioExistente = $usuario->buscarPorId($id);

    if ($usuarioExistente) {
      // Sanitizar e validar os dados aqui
      $usuarioExistente->nome = $dados['nome'] ?? $usuarioExistente->nome;
      $usuarioExistente->email = $dados['email'] ?? $usuarioExistente->email;
      if (isset($dados['senha']) && $dados['senha']) {
        $usuarioExistente->senha = password_hash($dados['senha'], PASSWORD_DEFAULT);
      }

      if ($usuarioExistente->atualizar()) {
        header('Location: /caminho/para/lista/de/usuarios');
      } else {
        header('Location: /caminho/para/formulario/de/edicao?id=' . $id . '&erro=1');
      }
    } else {
      header('Location: /caminho/para/lista/de/usuarios?erro=2');
    }
    exit;
  }

  public function deletar($id) {
    $usuario = new Usuario();
    if ($usuario->deletar($id)) {
      header('Location: /caminho/para/lista/de/usuarios');
    } else {
      header('Location: /caminho/para/lista/de/usuarios?erro=1');
    }
    exit;
  }

  public function login($email, $senha) {
    $usuario = new Usuario();
    $usuarioEncontrado = $usuario->buscarPorEmail($email);

    if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado->senha)) {
      session_start();
      $_SESSION['usuario_id'] = $usuarioEncontrado->id;
      $_SESSION['usuario_nome'] = $usuarioEncontrado->nome;
      header('Location: /caminho/para/pagina/inicial');
    } else {
      header('Location: /caminho/para/pagina/de/login?erro=1');
    }
    exit;
  }
}
?>
