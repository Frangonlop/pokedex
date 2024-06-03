import { searchPokemonByName } from "./api.js";

export async function displayPokemon(pokemonName) {
    const descriptionDiv = document.getElementById("description");
    const statsContainer = document.getElementById("stats");
    const pokemonNameElement = document.getElementById("pokemonName");
    const pokemonFrontImage = document.getElementById("pokemonFrontImage");
    const pokemonBackImage = document.getElementById("pokemonBackImage");
    const detailsList = document.getElementById("detailsList");

    // Limpiar contenido al inicio
    pokemonNameElement.textContent = "Busca un Pokémon";
    pokemonFrontImage.setAttribute('src', "");
    pokemonBackImage.setAttribute('src', "");
    detailsList.innerHTML = "";
    descriptionDiv.innerHTML = "";
    statsContainer.style.display = "none";

    // Verificar si el nombre del Pokémon está vacío
    if (!pokemonName.trim()) {
        return;
    }

    try {
        const pokemon = await searchPokemonByName(pokemonName);

        // Mostrar nombre y número de la Pokédex
        pokemonNameElement.textContent = `${pokemon.name} (#${pokemon.id})`;

        // Mostrar imágenes
        pokemonFrontImage.setAttribute('src', pokemon.sprites.front_default);
        pokemonBackImage.setAttribute('src', pokemon.sprites.back_default);

        // Mostrar detalles
        const heightItem = document.createElement("li");
        const heightInMeters = (pokemon.height / 10).toFixed(2);
        heightItem.textContent = `Altura: ${heightInMeters} m`;
        detailsList.appendChild(heightItem);

        const weightItem = document.createElement("li");
        const weightInKg = (pokemon.weight / 10).toFixed(2);
        weightItem.textContent = `Peso: ${weightInKg} kg`;
        detailsList.appendChild(weightItem);

        const typesItem = document.createElement("li");
        typesItem.textContent = `Tipos: ${pokemon.types.map(type => type.type.name).join(", ")}`;
        detailsList.appendChild(typesItem);

        // Mostrar stats
        statsContainer.style.display = "block"; // Mostrar el contenedor de stats

        const statsMapping = {
            "hp": "hpProgress",
            "attack": "attackProgress",
            "defense": "defenseProgress",
            "special-attack": "specialAttackProgress",
            "special-defense": "specialDefenseProgress",
            "speed": "speedProgress"
        };

        // Resetear todas las barras de progreso antes de actualizarlas
        for (const key in statsMapping) {
            const progressBar = document.getElementById(statsMapping[key]);
            const progressValue = document.getElementById(`${statsMapping[key].replace("Progress", "Value")}`);
            if (progressBar && progressValue) {
                progressBar.style.width = "0%";
                progressValue.textContent = "0";
            }
        }

        pokemon.stats.forEach(stat => {
            const progressBar = document.getElementById(statsMapping[stat.stat.name]);
            if (progressBar) {
                const progressValue = document.getElementById(`${statsMapping[stat.stat.name].replace("Progress", "Value")}`);
                progressBar.style.width = `${(stat.base_stat / 150) * 100}%`;
                progressValue.textContent = stat.base_stat;
            }
        });

        // Mostrar descripción
        const speciesData = await fetch(pokemon.species.url).then(response => response.json());
        const descriptionText = speciesData.flavor_text_entries.find(entry => entry.language.name === "es");
        const descriptionParagraph = document.createElement("p");
        if (descriptionText) {
            descriptionParagraph.textContent = `${descriptionText.flavor_text}`;
        } else {
            descriptionParagraph.textContent = "No description yet";
        }
        descriptionDiv.appendChild(descriptionParagraph);
    } catch (error) {
        console.error(error.message);
        pokemonNameElement.textContent = "No se encontró ningún Pokémon con ese nombre.";
        statsContainer.style.display = "none";
    }
}
