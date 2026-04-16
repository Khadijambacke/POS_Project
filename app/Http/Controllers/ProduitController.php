<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Support\Facades\Auth;

class ProduitController extends Controller
{
    public function index()
    {
        $produits=Produit::all();
        $categories = Categorie::all(); 
        return view('produit.index', compact('produits', 'categories'));

    }
    
    public function store(Request $request)
{
    $imageName = null;

    if($request->hasFile('image')){
        $image = $request->file('image');
        $imageName = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('ressources/assets'), $imageName);
    
    }
    if(empty($request->code_barre)){
        do {
            $code_barre = str_pad(rand(1,999999999999), 12,'0',STR_PAD_LEFT);
        } while(Produit::where('code_barre', $code_barre)->exists());
    } else {
        $code_barre = $request->code_barre;
    }
    Produit::create([
        'categories_id' => $request->categories_id, 
        'nom' => $request->nom,
        'description' => $request->description,
        'prixappro' => $request->prixappro,
        'prix_vente' => $request->prix_vente,
        'qtestock' => $request->qtestock,
        'image' => $imageName,
        'code_barre' => $code_barre,
        'statut' => 'disponible'
    ]);
    return redirect()->back();
}
 
    public function edit($produit)
    {
        $produit = Produit::findOrFail($produit);
        $categories = Categorie::all();

        return view('produit.edit', compact('produit', 'categories'));
    }

  
    public function update(Request $request, $produit)
    {
        $produit = Produit::findOrFail($produit);

        $validated = $request->validate([
            'categories_id' => 'required|exists:categories,id',
            'nom'           => 'required|string|max:255',
            'description'   => 'required|string',
            'prixappro'     => 'required|numeric',
            'prix_vente'    => 'required|numeric',
            'qtestock'      => 'required|integer',
            'image'         => 'nullable|image|max:2048',
            'statut'        => 'required|in:disponible,enrupture',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($validated);

        return redirect()
            ->route('vueproduit.index')
            ->with('success', 'Produit mis à jour avec succès');
    }
    public function show($produit)
    {
        $produit = Produit::with('categorie')->findOrFail($produit);
        
        ///retun redirect:(nom de ma route)

        return view('produit.show', compact('produit'));
    }


    public function destroy($produit)
    {
        $produit = Produit::findOrFail($produit);
        $produit->delete();

        return redirect()
            ->route('vueproduit.index')
            ->with('success', 'Produit supprimé avec succès');
    }
    
}
