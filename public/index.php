<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Ajuste para o caminho correto do seu arquivo de login
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main-container">
        <h1>Bem-vindo ao Nosso Site, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
        <p>Esta é a página inicial do nosso site.</p>
    </div>
</body>
</html>
