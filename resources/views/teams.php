<?php
session_start();

$archivo = "../../config/config.php";
if (!file_exists($archivo)) {
    header("Location: ../../install/install_view1.php");
}

include '../../config/config.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['login'])) {
    header("Location: login.php?redirect=teams.php");
    exit();
}

$login = $_SESSION['login'];

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

// Obtener los equipos del usuario
$stmt = $conn->prepare("SELECT id, nombre_equipo, fecha_creacion FROM equipos WHERE usuario_id = ?");
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$stmt->bind_result($equipo_id, $nombre_equipo, $fecha_creacion);
$equipos = [];
while ($stmt->fetch()) {
    $equipos[] = ['id' => $equipo_id, 'nombre_equipo' => $nombre_equipo, 'fecha_creacion' => $fecha_creacion];
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Equipos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
        <link rel="stylesheet" href="../css/main.css">
        <script src="../js/popup.js"></script>
</head>
<body>
    <div class="container">
        <nav>
            <ul class="menu">
                <li><a href="../../index.php" class="teams">Inicio</a></li>
                <div>
                    <?php if (isset($_SESSION['login'])): ?>
                        <li><a class="name signup"><?php echo htmlspecialchars($_SESSION['login']); ?></a></li>
                        <li><a href="../model/logout.php" class="logout">Cerrar sesión</a></li>
                    <?php else: ?>
                        <li><a href="login.php?redirect=teams.php">Iniciar sesión</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
        <div class="equipos">
            <h1>Mis Equipos</h1>
            <div class="equipos_order">
                    <?php if (empty($equipos)): ?>
                        <p>No tienes equipos creados.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($equipos as $equipo): ?>
                                <li>
                                    <h2><?php echo htmlspecialchars($equipo['nombre_equipo']); ?></h2>
                                    <p>Fecha de creación: <?php echo htmlspecialchars($equipo['fecha_creacion']); ?></p>
                                    <a href="ver_equipo.php?id=<?php echo $equipo['id']; ?>" class="view">Ver equipo</a>
                                    <form action="../model/delete_team.php" method="post" style="display:inline;" onsubmit="confirmDelete(event)">
                                        <input type="hidden" name="equipo_id" value="<?php echo $equipo['id']; ?>">
                                        <button type="submit" class="del-btn">Eliminar</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                        </div>
            <p class="create"><a href="create_team.php">Crear un nuevo equipo</a></p>
        </div>
    </div>
</body>
</html>
