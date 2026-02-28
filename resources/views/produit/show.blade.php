@extends('layouts.dashadmin')
@section('contenu')
<link rel="stylesheet" href="{{ asset('ressources/css/showproduit.css') }}">
<div class="container mt-4">

<div class="container mt-4 d-flex justify-content-center">
    <div class="product-show-card shadow-sm rounded d-flex flex-column">

    
        <div class="position-relative text-center">
            @if($produit->image)
                <img src="{{ asset('ressources/assets/' . $produit->image) }}" class="product-main-img rounded">
            @else
                <div class="bg-light d-flex align-items-center justify-content-center" style="height:250px;">
                    <i class="bi bi-image text-muted fs-1"></i>
                </div>
            @endif
            <span class="product-badge {{ $produit->statut == 'disponible' ? 'badge-success' : 'badge-danger' }}">
                {{ $produit->statut }}
            </span>
        </div>


        <div class="product-info flex-grow-1 px-3 py-2 text-center">
            <h2 class="fw-bold">{{ $produit->nom }}</h2>
            <div class="h4 text-danger">{{ number_format($produit->prix_vente,0,',',' ') }} FCFA</div>
            <p class="text-muted mt-2">{{ $produit->description ?? 'Aucune description disponible.' }}</p>
            <p><strong>Catégorie :</strong> {{ $produit->categorie->nom ?? 'Non attribué' }}</p>
            <p><strong>Stock :</strong> {{ $produit->qtestock ?? 0 }}</p>
            <p><strong>Prix Achat :</strong> {{ number_format($produit->prixappro,0,',',' ') }} FCFA</p>
        </div>

 
        <div class="product-footer d-flex justify-content-center gap-2 p-3 border-top">
            <a href="{{ route('vueproduit.index') }}" class="btn btn-secondary btn-action">Retour</a>

            @if(Auth::user()->role === 'admin')
                <a href="{{ route('vueproduit.edit', $produit->id) }}" class="btn btn-primary btn-action">Modifier</a>

                <form action="{{ route('vueproduit.destroy', $produit->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-action">Supprimer</button>
                </form>
            @endif
        </div>
    </div>
</div>



   
</div>
@endsection
