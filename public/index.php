<?php
include_once 'controllers/UsuarioController.php';
include_once 'controllers/VendaController.php';
include_once 'controllers/CarrinhoController.php';

// Simples roteamento baseado na query string
$controller = $_GET['controller'] ?? 'usuario';
$action = $_GET['action'] ?? 'listar';

$controllerName = ucfirst($controller) . 'Controller';
$controller = new $controllerName();

$controller->$action();
?>
