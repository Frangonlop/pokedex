<?php
include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (!isset($_SESSION['login'])) {
        header("Location: ../views/login.php");
        exit();
    }

    $usuario_login = $_SESSION['login'];
    $nombre_equipo = $_POST['nombre_equipo'];
    $nombres_pokemon = $_POST['nombres_pokemon'];

    // Crear la conexión
    $conn = new mysqli($HOST, $NAME, $PASSWORD, $BD, $PORT);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener el ID del usuario
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE login = ?");
    $stmt->bind_param("s", $usuario_login);
    $stmt->execute();
    $stmt->bind_result($usuario_id);
    $stmt->fetch();
    $stmt->close();

    // Insertar el equipo en la tabla de equipos
    $stmt = $conn->prepare("INSERT INTO equipos (nombre_equipo, usuario_id) VALUES (?, ?)");
    $stmt->bind_param("si", $nombre_equipo, $usuario_id);
    $stmt->execute();
    $equipo_id = $stmt->insert_id;
    $stmt->close();

    // Insertar los Pokémon asociados al equipo en la tabla de equipo_pokemon
    $stmt = $conn->prepare("INSERT INTO equipo_pokemon (equipo_id, pokemon_id) VALUES (?, ?)");

    foreach ($nombres_pokemon as $nombre_pokemon) {
        // Obtener el ID del Pokémon desde la PokeAPI
        $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower($nombre_pokemon);
        $pokemon_data = json_decode(file_get_contents($url), true);
        $pokemon_id = $pokemon_data['id'];

        // Insertar el Pokémon en la tabla
        $stmt->bind_param("ii", $equipo_id, $pokemon_id);
        $stmt->execute();
    }

    $stmt->close();
    $conn->close();

    // Redireccionar a la página de equipos
    header("Location: ../views/teams.php");
    exit();
}
?>
