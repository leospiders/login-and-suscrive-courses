<!-- lr_mis_inscripciones.php -->

<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$nombre = $_SESSION['nombre'];
$apellido_paterno = $_SESSION['apellido_paterno'];
$apellido_materno = $_SESSION['apellido_materno'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['anular'])) {
    $inscripcion_id = $_POST['inscripcion_id'];

    $stmt = $conn->prepare("DELETE FROM inscripciones WHERE id = ?");
    $stmt->bind_param("i", $inscripcion_id);

    if ($stmt->execute()) {
        echo "<script>alert('Inscripción anulada correctamente');</script>";
    } else {
        echo "<script>alert('Error al anular la inscripción');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Mis Inscripciones</title>
</head>
<body>
    <div class="container">
        <header>
            <h2>Mis Inscripciones</h2>
            <div class="user-info">
                <span><?php echo "$nombre $apellido_paterno $apellido_materno"; ?></span>
                <div class="profile-pic"><?php echo strtoupper($nombre[0] . $apellido_paterno[0]); ?></div>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="lr_actividades.php">Volver a Actividades</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <main>
            <h3>Lista de Inscripciones</h3>
            <table>
                <tr>
                    <th>Nro Actividad</th>
                    <th>Actividad</th>
                    <th>Acción</th>
                </tr>
                <?php
                $stmt = $conn->prepare("SELECT inscripciones.id, actividades.nombre FROM inscripciones INNER JOIN actividades ON inscripciones.actividad_id = actividades.id WHERE inscripciones.usuario_id = ?");
                $stmt->bind_param("i", $usuario_id);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>
                                <form method='POST'>
                                    <input type='hidden' name='inscripcion_id' value='{$row['id']}'>
                                    <button type='submit' name='anular'>Anular Inscripción</button>
                                </form>
                            </td>
                          </tr>";
                }

                $stmt->close();
                ?>
            </table>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
