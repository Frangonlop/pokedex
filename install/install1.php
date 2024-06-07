<?php
$archivoConfig = "../config/config.php";
if (file_exists($archivoConfig)) {
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['confirmar'])) {
    // Creación del archivo config
    $configContent = "<?php\n"
        . '$HOST="' . $_POST['host'] . "\";\n"
        . '$NAME="' . $_POST['nombre'] . "\";\n"
        . '$PASSWORD="' . $_POST['pass'] . "\";\n"
        . '$BD="' . $_POST['bd'] . "\";\n"
        . '$PORT="' . $_POST['puerto'] . "\";\n?>";

    $mifichero = fopen("../config/config.php", "w");
    if ($mifichero) {
        fwrite($mifichero, $configContent);
        fclose($mifichero);
    } else {
        echo "Error al abrir el archivo de configuración";
        exit;
    }
}

// Sentencias para la creación de la base de datos
require_once "../config/config.php";
$conexion = new mysqli($HOST, $NAME, $PASSWORD, $BD, $PORT);

$crearUsuarios = "CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `login` VARCHAR(100) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
    `pass` VARCHAR(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de usuarios';";

$crearEquipos = "CREATE TABLE IF NOT EXISTS `equipos` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nombre_equipo` VARCHAR(255) NOT NULL,
    `usuario_id` INT,
    `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de equipos';";

$crearEquipoPokemon = "CREATE TABLE IF NOT EXISTS `equipo_pokemon` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `equipo_id` INT,
    `nombre_pokemon` VARCHAR(255) NOT NULL,
    FOREIGN KEY (`equipo_id`) REFERENCES `equipos`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de equipo_pokemon';";


if ($conexion->query($crearUsuarios) === TRUE && 
    $conexion->query($crearEquipos) === TRUE && 
    $conexion->query($crearEquipoPokemon) === TRUE) {
    header("Location: ../index.php");
    exit;
} else {
    echo "Error al crear las tablas: " . $conexion->error;
    exit;
}
?>
