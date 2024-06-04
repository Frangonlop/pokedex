<?php
session_start();

include '../../config/config.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['login'])) {
    header("Location: ../views/login.php?redirect=teams.php");
    exit();
}

$login = $_SESSION['login'];

// Verificar que se haya enviado el ID del equipo
if (!isset($_POST['equipo_id'])) {
    echo "ID de equipo no proporcionado.";
    exit();
}

$equipo_id = $_POST['equipo_id'];

// Crear la conexión
$conn = new mysqli($HOST, $NAME, $PASSWORD, $BD, $PORT);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del usuario
$stmt = $conn->prepare("SELECT id FROM usuarios WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$stmt->bind_result($usuario_id);
$stmt->fetch();
$stmt->close();

// Verificar que el equipo pertenece al usuario
$stmt = $conn->prepare("SELECT id FROM equipos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $equipo_id, $usuario_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $stmt->close();
    $conn->close();
    echo "El equipo no existe o no pertenece al usuario.";
    exit();
}

$stmt->close();

// Eliminar las relaciones del equipo en la tabla de relaciones (ajusta el nombre de la tabla y la columna si es necesario)
$stmt = $conn->prepare("DELETE FROM equipo_pokemon WHERE equipo_id = ?");
$stmt->bind_param("i", $equipo_id);
$stmt->execute();
$stmt->close();

// Eliminar el equipo
$stmt = $conn->prepare("DELETE FROM equipos WHERE id = ?");
$stmt->bind_param("i", $equipo_id);
$stmt->execute();
$stmt->close();

$conn->close();

header("Location: ../views/teams.php");
exit();
?>
