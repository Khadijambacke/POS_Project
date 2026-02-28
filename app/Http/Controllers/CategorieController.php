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
         
        ]);

        Categorie::create($validated);

        return redirect()
            ->route('toutcategrie')
            ->with('success', 'Catégorie créée avec succès');
    } 
    public function edit($categorie)
    {
        $categorie = Categorie::findOrFail($categorie);
        return view('categories.edit', compact('categorie'));

    }
    public function update(Request $request,$categorie)
    {
        $categorie = Categorie::findOrFail($categorie);
    
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);
        $categorie->update($validated);
        return redirect()
            ->route('toutcategrie')
            ->with('success', 'Categorie mis à jour avec succès');
        
    }
    
    public function  delete(Request $request,$categorie){
        $categorie = Categorie::findOrFail($categorie);
        $categorie->delete();
        return redirect()->route('toutcategrie');
    }
}


