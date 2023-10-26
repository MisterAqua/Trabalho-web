<?php
$servername = "localhost";
$username = " ";
$password = "root";
$dbname = "venda";

// Criando conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checando a conexão
if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}
?>