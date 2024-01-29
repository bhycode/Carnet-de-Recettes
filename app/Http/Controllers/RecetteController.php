<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;


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

        return redirect()->route('recettes.create');
}

}
