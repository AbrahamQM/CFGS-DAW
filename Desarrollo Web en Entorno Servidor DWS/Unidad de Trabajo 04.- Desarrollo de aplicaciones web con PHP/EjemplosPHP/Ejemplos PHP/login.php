<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar sesión</title>
</head>
<body>
  <h2>Acceso de usuarios</h2>
  <form action="validate.php" method="POST">
    <label>Usuario:</label>
    <input type="text" name="username" required><br><br>
    <label>Contraseña:</label>
    <input type="password" name="password" required><br><br>
    <button type="submit">Acceder</button>
  </form>
</body>
</html>
