import { searchPokemonByName } from "./api.js";

export async function getDefaultPokemon() {
    const defaultPokemonName = "bulbasaur"; // Cambiar el nombre del Pokémon por defecto si es necesario
    return await searchPokemonByName(defaultPokemonName);
}


export async function toggleShiny(pokemonName) {
    const pokemon = await searchPokemonByName(pokemonName);
    const imageElement = document.getElementById("pokemonFrontImage");
    const backImageElement = document.getElementById("pokemonBackImage");

    if (imageElement.getAttribute('src') === pokemon.sprites.front_default) {
        imageElement.setAttribute('src', pokemon.sprites.front_shiny);
        backImageElement.setAttribute('src', pokemon.sprites.back_shiny);
        document.getElementById("shinyButton").textContent = "Versión normal"; // Cambiar texto del botón
    } else if (imageElement.getAttribute('src') === pokemon.sprites.front_shiny) {
        imageElement.setAttribute('src', pokemon.sprites.front_default);
        backImageElement.setAttribute('src', pokemon.sprites.back_default);
        document.getElementById("shinyButton").textContent = "Versión shiny"; // Cambiar texto del botón
    } else if (imageElement.getAttribute('src') === pokemon.sprites.back_default) {
        imageElement.setAttribute('src', pokemon.sprites.back_shiny);
        backImageElement.setAttribute('src', pokemon.sprites.front_shiny);
        document.getElementById("shinyButton").textContent = "Versión normal"; // Cambiar texto del botón
    } else {
        imageElement.setAttribute('src', pokemon.sprites.back_default);
        backImageElement.setAttribute('src', pokemon.sprites.front_default);
        document.getElementById("shinyButton").textContent = "Versión shiny"; // Cambiar texto del botón
    }
}

export async function toggleFlip() {
    const imageElement = document.getElementById("pokemonFrontImage");
    const backImageElement = document.getElementById("pokemonBackImage");
    const currentFrontSrc = imageElement.getAttribute('src');
    const currentBackSrc = backImageElement.getAttribute('src');

    if (currentFrontSrc && currentBackSrc) {
        imageElement.setAttribute('src', currentBackSrc);
        backImageElement.setAttribute('src', currentFrontSrc);
    }
}
