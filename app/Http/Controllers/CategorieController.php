<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorie;
use App\Models\Produit;

class CategorieController extends Controller
{

    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'         => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut'      => 'required|in:actif,inactif',
        ]);

        Categorie::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie créée avec succès');
    } 
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('categories.edit', compact('categorie'));

    }
  
    public function update(Request $request,  Categorie $categorie)
    {
        $categorie = Categorie::findOrFail($categorie);

        $validated = $request->validate([
            'nom'         => 'required|string|max:255',
            'description' => 'nullable|string',
            'statut'      => 'required|in:actif,inactif',
        ]);

        $categorie->update($validated);
        if ($validated['statut'] === 'inactif') {
            Produit::where('categories_id', $categorie->id)
                   ->update(['statut' => 'enrupture']);
        } else { 
            Produit::where('categories_id', $categorie->id)
                   ->update(['statut' => 'disponible']);
        }
    
        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie modifiée avec succès');
    }


    public function delete($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès');
    }
}


