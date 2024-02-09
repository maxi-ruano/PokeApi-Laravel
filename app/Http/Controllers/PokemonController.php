<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;


class PokemonController extends Controller
{

public function index()
    {
        $cachedData = Cache::get('pokemon_data');
    
        if ($cachedData) {
            $pokemons = $cachedData;
        } else {
            $apiUrl = 'https://pokeapi.co/api/v2/pokemon';
            $response = file_get_contents($apiUrl);
            $data = json_decode($response, true);
    
            $pokemons = $data['results'];
    
            foreach ($pokemons as &$pokemon) {
                $detailsResponse = file_get_contents($pokemon['url']);
                $details = json_decode($detailsResponse, true);
                $image_url = data_get($details, 'sprites.front_default', null);
    
                $pokemon['image_url'] = $image_url;
    
                $pokemon['id'] = $details['id'];
            }
    
            Cache::put('pokemon_data', $pokemons, 3600);
        }
        $searchTerm = request('name');
        if ($searchTerm) {
            $pokemons = array_filter($pokemons, function ($pokemon) use ($searchTerm) {
                return stripos($pokemon['name'], $searchTerm) !== false;
            });
        }


        $perPage = 10;
        $currentPage = request('page', 1);
        $totalItems = count($pokemons);
        $offset = ($currentPage - 1) * $perPage;
    
        $paginatedResults = array_slice($pokemons, $offset, $perPage);
    
        $paginatedResults = new LengthAwarePaginator(
            $paginatedResults,
            $totalItems,
            $perPage,
            $currentPage,
            ['path' => url('/'), 'query' => request()->query()]
        );
        $searchResults = !empty(request('name')) ? $paginatedResults->items() : null;

        return view('pokemons.index', compact('paginatedResults','searchResults'));
    }



    public function show($id)
    {
        $response = Http::get("https://pokeapi.co/api/v2/pokemon/{$id}");
        $pokemon = $response->json();

        return view('pokemons.show', compact('pokemon'));
    }
}
