<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;

use Illuminate\Support\Facades\Storage;


class RecetteController extends Controller
{
    public function create()
    {
        return view('addRecette');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        // Create a new Recette instance
        $recette = Recette::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('recettes.index');
    }

    public function index()
    {
        $recettes = Recette::all();
        return view('showRecettes', ['recettes' => $recettes]);
    }

    public function destroy(Recette $recette)
    {
        // Supprimer l'image du stockage
        $imagePath = 'public/' . $recette->image_path;

        if ($recette->image_path && Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }

        // Supprimer la Recette de la base de données
        $recette->delete();

        // Rediriger vers la liste des Recettes avec un message de succès
        return redirect()->route('recettes.index')->with('success', 'Recette supprimée avec succès');
    }


    public function update(Request $request, Recette $recette)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($recette->image_path) {
                Storage::delete('public/' . $recette->image_path);
            }

            // Enregistrer la nouvelle image
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $recette->image_path;
        }

        // Mettre à jour la Recette
        $recette->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image_path' => $imagePath,
        ]);

        return redirect()->route('recettes.index')->with('success', 'Recette mise à jour avec succès');
    }


    public function edit(Recette $recette)
    {
        return view('updateRecette', compact('recette'));
    }

}
