<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recette;

use Illuminate\Support\Facades\Storage;


class RecetteController extends Controller
{

    private $not_found_img_path = "images/img-not-found.jpg";

    public function create()
    {
        return view('addRecette');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:30000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $this->not_found_img_path;
        }


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

        $imagePath = 'public/' . $recette->image_path;

        if ($recette->image_path && Storage::exists($imagePath) && $recette->image_path != $this->not_found_img_path) {
            Storage::delete($imagePath);
        }


        $recette->delete();


        return redirect()->route('recettes.index')->with('success', 'Recette supprimée avec succès');
    }


    public function update(Request $request, Recette $recette)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('image')) {

            if ($recette->image_path && $recette->image_path != $this->not_found_img_path) {
                Storage::delete('public/' . $recette->image_path);
            }


            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $recette->image_path;
        }


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


    public function indexWithoutButtons()
    {
        $recettes = Recette::all();
        return view('Recettes', ['recettes' => $recettes]);
    }



    public function search(Request $request)
    {
        $search = $request->input('search');

        $recettes = Recette::where('title', 'like', "%$search%")
            ->orWhere('content', 'like', "%$search%")
            ->get();

        return view('Recettes', ['recettes' => $recettes]);
    }


    public function showFull(Recette $recette)
    {
        return view('showFullRecette', compact('recette'));
    }


}
