<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{




    public function index()
    {
        $response = Http::get('https://pokeapi.co/api/v2/pokemon');
        $pokemons = $response->json()['results'];

        foreach ($pokemons as &$pokemon) {
            $detailsResponse = Http::get($pokemon['url']);
            $details = $detailsResponse->json();
            $image_url = data_get($details, 'sprites.front_default', null);

            if ($image_url) {
                $pokemon['image_url'] = $image_url;
            } else {
                $pokemon['image_url'] = 'URL_DE_IMAGEN_DE_REEMPLAZO_O_BLANCO';
            }

            $pokemon['id'] = $details['id'];
        }

        $searchTerm = request('name');
        if ($searchTerm) {
            $pokemons = array_filter($pokemons, function ($pokemon) use ($searchTerm) {
                return stripos($pokemon['name'], $searchTerm) !== false;
            });
        }

        $collection = collect($pokemons);

        $perPage = 10;
        $currentPage = request('page', 1);

        $paginatedResults = new \Illuminate\Pagination\LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => url('/'), 'query' => request()->query()]
        );
        $searchResults = !empty(request('name')) ? $paginatedResults->items() : null;

        return view('pokemons.index', compact('paginatedResults', 'searchResults'));
    }





    public function show($id)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
        $pokemon = $response->json();

        return view('pokemons.show', compact('pokemon'));
    }
}
