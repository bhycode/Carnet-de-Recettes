<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RecetteController;


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

// Route::get('/', function () {
//     $recette = Recette::find(1); // Replace with the appropriate logic to retrieve a Recette
//     return view('showRecettes', ['recette' => $recette]);
// });



// Create and store
Route::get('/recettes/create', [RecetteController::class, 'create'])->name('recettes.create');
Route::post('/recettes', [RecetteController::class, 'store'])->name('recettes.store');

// Show
Route::get('/recettes', [RecetteController::class, 'index'])->name('recettes.index');

// Delete
Route::delete('/recettes/{recette}', [RecetteController::class, 'destroy'])->name('recettes.destroy');


// Update
Route::get('/recettes/{recette}/edit', [RecetteController::class, 'edit'])->name('recettes.edit');
Route::put('/recettes/{recette}', [RecetteController::class, 'update'])->name('recettes.update');

// Show Recettes only
Route::get('/', [RecetteController::class, 'indexWithoutButtons'])->name('recettes.indexWithoutButtons');

// Search
Route::get('/recettes/search', [RecetteController::class, 'search'])->name('recettes.search');

// Show full content
Route::get('/recettes/{recette}/showFull', [RecetteController::class, 'showFull'])->name('recettes.showFull');

