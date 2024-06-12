import { searchPokemonByName } from "./api.js";

export async function getDefaultPokemon() {
    const defaultPokemonName = "bulbasaur"; // Nombre del pokemon por defecto
    return await searchPokemonByName(defaultPokemonName);
}


export async function toggleShiny(pokemonName) {
    const pokemon = await searchPokemonByName(pokemonName);
    const imageElement = document.getElementById("pokemonFrontImage");
    const backImageElement = document.getElementById("pokemonBackImage");

    if (imageElement.getAttribute('src') === pokemon.sprites.front_default) {
        imageElement.setAttribute('src', pokemon.sprites.front_shiny);
        backImageElement.setAttribute('src', pokemon.sprites.back_shiny);
        document.getElementById("shinyButton").textContent = "Versión normal";
    } else if (imageElement.getAttribute('src') === pokemon.sprites.front_shiny) {
        imageElement.setAttribute('src', pokemon.sprites.front_default);
        backImageElement.setAttribute('src', pokemon.sprites.back_default);
        document.getElementById("shinyButton").textContent = "Versión shiny";
    } else if (imageElement.getAttribute('src') === pokemon.sprites.back_default) {
        imageElement.setAttribute('src', pokemon.sprites.back_shiny);
        backImageElement.setAttribute('src', pokemon.sprites.front_shiny);
        document.getElementById("shinyButton").textContent = "Versión normal";
    } else {
        imageElement.setAttribute('src', pokemon.sprites.back_default);
        backImageElement.setAttribute('src', pokemon.sprites.front_default);
        document.getElementById("shinyButton").textContent = "Versión shiny";
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
