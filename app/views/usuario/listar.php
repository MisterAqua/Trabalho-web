<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listar Usuários</title>
</head>
<body>
  <h1>Lista de Usuários</h1>
  <!-- Código para listar os usuários -->
  <?php foreach ($usuarios as $usuario): ?>
    <div><?php echo $usuario->nome; ?></div>
  <?php endforeach; ?>
</body>
</html>