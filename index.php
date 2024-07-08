
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required>
            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" required>
            <button type="submit">Ingresar</button>
        </form>
        <div class="oauth-buttons">
            <a href="google-login.php" class="btn btn-google">Login con Google</a>
            <a href="facebook-login.php" class="btn btn-facebook">Login con Facebook</a>
        </div>
        <p>¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a>.</p>
    </div>
</body>
</html>
