<?php
session_start();
$archivo = "../../config/config.php";
if (!file_exists($archivo)) {
    header("Location: ../../install/install_view1.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Equipo</title>
    <link rel="stylesheet" href="../css/main.css">
    <script type="module" src="../js/main.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div class="container">
        <nav>
            <ul class="menu">
                <li><a href="../../index.php" class="teams">Inicio</a></li>
                <li><a href="teams.php" class="return">Volver a mis equipos</a></li>
                <div>
                    <?php if (isset($_SESSION['login'])): ?>
                        <li><a class="signup"><?php echo htmlspecialchars($_SESSION['login']); ?></a></li>
                        <li><a href="../model/logout.php" class="logout">Cerrar sesión</a></li>
                    <?php endif; ?>
                </div>
            </ul>
        </nav>
        <div class="equipos">
            <h1>Crear Equipo</h1>
            <form action="../model/create_team.php" method="post">
                <div class="team_name">
                    <label for="nombre_equipo">Nombre del Equipo:</label>
                    <input type="text" id="nombre_equipo" name="nombre_equipo" required>
                </div>
                <label for="nombres_pokemon">Nombres de los Pokémon (uno por campo):</label>
                <input type="text" id="nombres_pokemon1" name="nombres_pokemon[]" required oninput="displayPokemon(this.value)">
                <div class="form_team">
                    <input type="text" id="nombres_pokemon2" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
                    <input type="text" id="nombres_pokemon3" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
                    <input type="text" id="nombres_pokemon4" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
                    <input type="text" id="nombres_pokemon5" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
                    <input type="text" id="nombres_pokemon6" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
                </div>
                <button type="submit" class="create_team">Crear Equipo</button>
            </form>
        </div>
    </div>
</body>
</html>
