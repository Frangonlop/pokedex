<?php
session_start();
// Verificar si el archivo de configuración existe
$archivo = "./config/config.php";
if (!file_exists($archivo)) {
    header("Location: ./install/install_view1.php");
}
require_once ("./config/config.php");
$conexion = new mysqli($HOST, $NAME, $PASSWORD, $BD, $PORT);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="resources/css/main.css">
</head>

<body>
    <div class="container">
        <nav>
            <ul class="menu">
                <li><a href="./resources/views/teams.php" class="teams">Equipos</a></li>
                <div>
                    <?php if (isset($_SESSION['login'])): ?>
                        <li><a class="name signup">Bienvenido, <?php echo htmlspecialchars($_SESSION['login']); ?></a></li>
                        <li><a href="./resources/model/logout.php" class="logout">Cerrar sesión</a></li>
                        <?php else: ?>
                            <li><a href="./resources/views/register.php" class="signup">Registrarse</a></li>
                            <li><a href="./resources/views/login.php" class="login">Iniciar sesión</a></li>
                            <?php endif; ?>
                        </div>
                    </ul>
                </nav>
                <div id="app">
                    <div id="pokemonInfo">
                        <h1 id="pokemonName">Busca un Pokémon</h1>
                        <div id="pokemonImages">
                            <img id="pokemonFrontImage" src="" alt="Imagen del Pokémon">
                            <img id="pokemonBackImage" src="" alt="Imagen posterior del Pokémon" style="display: none;">
                        </div>
                        <div class="forms">
                            <button id="shinyButton">Versión shiny</button>
                            <button id="flipButton"><img class="flip" src="resources/img/actualizar.svg" alt="Dar la vuelta"></button>
                        </div>
                        <input type="text" id="searchInput" placeholder="Buscar Pokémon por nombre">
                        <div id="description"></div>
                    </div>
                    <div class="details">
                        <ul id="detailsList">
                            <!-- Aquí se mostrarán los detalles -->
                        </ul>
                        
                        <div id="stats">
                            <div class="stat-item">
                                <span class="progress-title">HP</span>
                                <span id="hpValue">0</span>
                                <div class="progress">
                                    <div class="progress-bar" id="hpProgress"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <span class="progress-title">Attack</span>
                                <span id="attackValue">0</span>
                                <div class="progress">
                                    <div class="progress-bar" id="attackProgress"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <span class="progress-title">Defense</span>
                                <span id="defenseValue">0</span>
                                <div class="progress">
                                    <div class="progress-bar" id="defenseProgress"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <span class="progress-title">Special Attack</span>
                                <span id="specialAttackValue">0</span>
                                <div class="progress">
                                    <div class="progress-bar" id="specialAttackProgress"></div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <span class="progress-title">Special Defense</span>
                                <span id="specialDefenseValue">0</span>
                                <div class="progress">
                        <div class="progress-bar" id="specialDefenseProgress"></div>
                    </div>
                </div>
                <div class="stat-item">
                    <span class="progress-title">Speed</span>
                    <span id="speedValue">0</span>
                    <div class="progress">
                        <div class="progress-bar" id="speedProgress"></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
<script type="module" src="resources/js/main.js"></script>
</body>

</html>