<!-- login.php -->
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conexion.php';

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conn->prepare("SELECT id, nombre, apellido_paterno, apellido_materno, contraseña FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nombre, $apellido_paterno, $apellido_materno, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($contraseña, $hashed_password)) {
        $_SESSION['usuario_id'] = $id;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['apellido_paterno'] = $apellido_paterno;
        $_SESSION['apellido_materno'] = $apellido_materno;
        header("Location: lr_actividades.php");
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.php';</script>";
                exit;
                header("Location: index.php");
    }

    $stmt->close();
    $conn->close();
}
?>

