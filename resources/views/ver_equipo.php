<?php
session_start();

$archivo = "../../config/config.php";
if (!file_exists($archivo)) {
    header("Location: ../../install/install_view1.php");
    exit();
}

include '../../config/config.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['login'])) {
    header("Location: login.php?redirect=teams.php");
    exit();
}

$login = $_SESSION['login'];

// Verificar que se haya enviado el ID del equipo
if (!isset($_GET['id'])) {
    echo "ID de equipo no proporcionado.";
    exit();
}

$equipo_id = $_GET['id'];

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
$stmt = $conn->prepare("SELECT nombre_equipo, fecha_creacion FROM equipos WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $equipo_id, $usuario_id);
$stmt->execute();
$stmt->bind_result($nombre_equipo, $fecha_creacion);
$stmt->fetch();
$stmt->close();

if (!$nombre_equipo) {
    echo "El equipo no existe o no pertenece al usuario.";
    $conn->close();
    exit();
}

// Obtener los Pokémon del equipo
$stmt = $conn->prepare("SELECT nombre_pokemon FROM equipo_pokemon WHERE equipo_id = ?");
$stmt->bind_param("i", $equipo_id);
$stmt->execute();
$stmt->bind_result($nombre_pokemon);
$pokemons = [];
while ($stmt->fetch()) {
    $pokemons[] = $nombre_pokemon;
}
$stmt->close();
$conn->close();

// Obtener los detalles de cada Pokémon usando la PokeAPI
$pokemon_details = [];
foreach ($pokemons as $nombre_pokemon) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower($nombre_pokemon);
    $pokemon_data = json_decode(file_get_contents($url), true);
    if ($pokemon_data) {
        $pokemon_details[] = [
            'nombre' => $pokemon_data['name'],
            'tipo' => $pokemon_data['types'][0]['type']['name'],
            'imagen' => $pokemon_data['sprites']['front_default']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Equipo</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <nav>
        <ul class="menu">
            <li><a href="../../index.php" class="teams">Inicio</a></li>
            <?php if (isset($_SESSION['login'])): ?>
                <li><a class="name signup"><?php echo htmlspecialchars($_SESSION['login']); ?></a></li>
                <li><a href="../model/logout.php" class="logout">Cerrar sesión</a></li>
            <?php else: ?>
                <li><a href="login.php?redirect=teams.php">Iniciar sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <h1>Detalles del Equipo</h1>
    <h2><?php echo htmlspecialchars($nombre_equipo); ?></h2>
    <p>Fecha de creación: <?php echo htmlspecialchars($fecha_creacion); ?></p>
    
    <h3>Pokémon en el equipo</h3>
    <?php if (empty($pokemon_details)): ?>
        <p>No hay Pokémon en este equipo.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($pokemon_details as $pokemon): ?>
                <li>
                    <img src="<?php echo htmlspecialchars($pokemon['imagen']); ?>" alt="<?php echo htmlspecialchars($pokemon['nombre']); ?>">
                    <?php echo htmlspecialchars($pokemon['nombre']); ?> - <?php echo htmlspecialchars($pokemon['tipo']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <p><a href="teams.php">Volver a mis equipos</a></p>
</body>
</html>
