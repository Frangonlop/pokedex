export async function searchPokemonByName(name){
    const response = await fetch (`https://pokeapi.co/api/v2/pokemon/${name}`);
    if (!response.ok) {
        throw new Error("No se encontró ningún Pokémon con ese nombre.");
    }
    const data = await response.json();
    return data;
}