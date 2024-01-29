<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $recette = Recette::find(1); // Replace with the appropriate logic to retrieve a Recette
    return view('showRecettes', ['recette' => $recette]);
});


use App\Http\Controllers\RecetteController;

Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');
Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');
