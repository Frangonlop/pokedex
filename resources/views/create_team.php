<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Equipo</title>
    <link rel="stylesheet" href="../css/main.css">
    <script type="module" src=../js/main.js"></script>
</head>
<body>
    <nav>
        <li><a href="../../index.php">Inicio</a></li>
        <?php if (isset($_SESSION['login'])): ?>
            <li><?php echo htmlspecialchars($_SESSION['login']); ?></li>
            <li><a href="../model/logout.php">Cerrar sesión</a></li>
        <?php endif; ?>
    </nav>
    <h1>Crear Equipo</h1>
    <form action="../model/create_team.php" method="post">
        <label for="nombre_equipo">Nombre del Equipo:</label>
        <input type="text" id="nombre_equipo" name="nombre_equipo" required>
        <label for="nombres_pokemon">Nombres de los Pokémon (uno por campo):</label>
        <input type="text" id="nombres_pokemon1" name="nombres_pokemon[]" required oninput="displayPokemon(this.value)">
        <input type="text" id="nombres_pokemon2" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
        <input type="text" id="nombres_pokemon3" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
        <input type="text" id="nombres_pokemon4" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
        <input type="text" id="nombres_pokemon5" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
        <input type="text" id="nombres_pokemon6" name="nombres_pokemon[]" oninput="displayPokemon(this.value)">
        <button type="submit">Crear Equipo</button>
    </form>

    <div id="pokemonInfo">
        <h2 id="pokemonName">Busca un Pokémon</h2>
        <img id="pokemonFrontImage" src="" alt="Front Image">
        <img id="pokemonBackImage" src="" alt="Back Image">
        <ul id="detailsList"></ul>
        <div id="stats" style="display: none;">
            <div>HP: <span id="hpValue">0</span><div id="hpProgress" class="progress"></div></div>
            <div>Attack: <span id="attackValue">0</span><div id="attackProgress" class="progress"></div></div>
            <div>Defense: <span id="defenseValue">0</span><div id="defenseProgress" class="progress"></div></div>
            <div>Special Attack: <span id="specialAttackValue">0</span><div id="specialAttackProgress" class="progress"></div></div>
            <div>Special Defense: <span id="specialDefenseValue">0</span><div id="specialDefenseProgress" class="progress"></div></div>
            <div>Speed: <span id="speedValue">0</span><div id="speedProgress" class="progress"></div></div>
        </div>
        <div id="description"></div>
    </div>
</body>
</html>
