import { displayPokemon } from "./display.js";
import { toggleShiny, toggleFlip } from "./actions.js";

document.getElementById("shinyButton").addEventListener("click", async () => {
    let searchInput = document.getElementById("searchInput").value.trim().toLowerCase();
    if (!searchInput) {
        const defaultPokemon = await getDefaultPokemon();
        searchInput = defaultPokemon.name;
    }
    try {
        await toggleShiny(searchInput);
    } catch (error) {
        console.error(error.message);
    }
});

document.getElementById("flipButton").addEventListener("click", async () => {
    try {
        await toggleFlip();
    } catch (error) {
        console.error(error.message);
    }
});


let typingTimer;
const doneTypingInterval = 1000; // Intervalo de espera después de dejar de escribir (en milisegundos)

document.getElementById("searchInput").addEventListener("input", async (event) => {
    const searchInput = event.target.value.trim().toLowerCase();

    clearTimeout(typingTimer);
    if (searchInput || searchInput === "") { // Incluimos esta condición para que se llame a displayPokemon incluso cuando el campo de búsqueda esté vacío
        typingTimer = setTimeout(async () => {
            try {
                await displayPokemon(searchInput);
            } catch (error) {
                console.error(error.message);
                document.getElementById("pokemonName").textContent = "No se encontró ningún Pokémon con ese nombre.";
                document.getElementById("pokemonFrontImage").setAttribute('src', "");
                document.getElementById("pokemonBackImage").setAttribute('src', "");
                document.getElementById("detailsList").innerHTML = ""; // Limpiar la lista de detalles
                document.getElementById("stats").innerHTML = ""; // Limpiar el contenedor de stats
            }
        }, doneTypingInterval);
    } else {
        // Si el campo de búsqueda está vacío, muestra un mensaje para que el usuario ingrese un nombre
        document.getElementById("pokemonName").textContent = "Elige un Pokémon";
        document.getElementById("pokemonFrontImage").setAttribute('src', "");
        document.getElementById("pokemonBackImage").setAttribute('src', "");
        document.getElementById("detailsList").innerHTML = ""; // Limpiar la lista de detalles
        document.getElementById("stats").innerHTML = ""; // Limpiar el contenedor de stats
    }
});

document.addEventListener("DOMContentLoaded", async () => {
    try {
        await displayPokemon("bulbasaur");
    } catch (error) {
        console.error(error.message);
        document.getElementById("pokemonName").textContent = "No se encontró ningún Pokémon con ese nombre.";
        document.getElementById("pokemonFrontImage").setAttribute('src', "");
        document.getElementById("pokemonBackImage").setAttribute('src', "");
        document.getElementById("detailsList").innerHTML = ""; // Limpiar la lista de detalles
        document.getElementById("stats").innerHTML = ""; // Limpiar el contenedor de stats
    }
});
