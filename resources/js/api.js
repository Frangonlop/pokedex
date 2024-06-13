// Función para buscar un Pokémon por nombre
export async function searchPokemonByName(name) {
    const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}`);
    if (!response.ok) {
        throw new Error("No se encontró ningún Pokémon con ese nombre.");
    }
    const data = await response.json();
    return data;
}

// Función para obtener el tipo en español
export async function getTypeInSpanish(typeUrl) {
    const response = await fetch(typeUrl);
    if (!response.ok) {
        throw new Error("No se pudo obtener el tipo del Pokémon.");
    }
    const data = await response.json();
    const spanishEntry = data.names.find(name => name.language.name === 'es');
    return spanishEntry ? spanishEntry.name.toLowerCase() : null;
}
