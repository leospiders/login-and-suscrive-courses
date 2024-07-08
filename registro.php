<!-- registro.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form action="registro.php" method="POST" onsubmit="return validarFormulario()">
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellido_paterno">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" required>
            <label for="apellido_materno">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" required>
            <label for="correo">Correo</label>
            <input type="email" id="correo" name="correo" required>
            <label for="contraseña">Contraseña</label>
            <input type="password" id="contraseña" name="contraseña" required>
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" required>
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="index.php">Ingresa aquí</a>.</p>
    </div>
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $telefono = $_POST['telefono'];

    if (strlen($contraseña) < 8) {
        echo "<script>alert('La contraseña debe tener al menos 8 caracteres');</script>";
        exit;
    }

    if (!is_numeric($telefono)) {
        echo "<script>alert('El teléfono debe contener solo números');</script>";
        exit;
    }

    $primer_nombre = explode(' ', trim($nombre))[0];
    $usuario = strtolower($primer_nombre . '.' . $apellido_paterno);
    $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido_paterno, apellido_materno, correo, usuario, contraseña, telefono) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $apellido_paterno, $apellido_materno, $correo, $usuario, $hashed_password, $telefono);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error al registrar el usuario');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
