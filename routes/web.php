<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController;

Route::get('/', [PokemonController::class, 'index']);


Route::get('/pokemons/{id}', [PokemonController::class, 'show']);
