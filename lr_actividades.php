<!-- lr_actividades.php -->

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

$iniciales = strtoupper($nombre[0] . $apellido_paterno[0]);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['inscribir'])) {
    $actividad_id = $_POST['actividad_id'];

    $stmt = $conn->prepare("SELECT fecha FROM actividades WHERE id = ?");
    $stmt->bind_param("i", $actividad_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($fecha);
    $stmt->fetch();

    if (new DateTime($fecha) < new DateTime()) {
        echo "<script>alert('La fecha de inscripción ha pasado');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO inscripciones (usuario_id, actividad_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $usuario_id, $actividad_id);

        if ($stmt->execute()) {
            echo "<script>alert('Inscripción exitosa');</script>";
        } else {
            echo "<script>alert('Error al inscribirse');</script>";
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estiloss.css">
    <title>Actividades</title>
</head>
<body>
    <div class="container">
        <header>
            <h2>ACTIVIDADES</h2>
            <div class="user-info">
                <span><?php echo "$nombre $apellido_paterno $apellido_materno"; ?></span>
                <div class="profile-pic"><?php echo $iniciales; ?></div>
            </div>
        </header>
        <nav>
            <ul>
                <li><a href="lr_mis_inscripciones.php">Mis Actividades</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
        <main>
            <h3>Inscribirse en Actividades</h3>
            <table>
                <tr>
                    <th>Actividad</th>
                    <th>Costo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acción</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM actividades");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nombre']}</td>
                            <td>{$row['costo']} Bs</td>
                            <td>{$row['fecha']}</td>
                            <td>{$row['hora_inicio']} - {$row['hora_fin']}</td>
                            <td>
                                <form method='POST'>
                                    <input type='hidden' name='actividad_id' value='{$row['id']}'>
                                    <button type='submit' name='inscribir'>Inscribirme</button>
                                </form>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </main>
    </div>
</body>
</html>

<?php
$conn->close();
?>
