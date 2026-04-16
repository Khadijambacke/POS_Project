@extends('layouts.dashadmin')
@section('contenu')
<div class="container mt-4">
    <div class="card shadow border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square"></i> Modifier Produit
            </h5>
        </div>

        <div class="card-body">

            <form action="{{ route('vueproduit.update', $produit->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Image</label>
                    <input type="file" name="image" class="form-control form-control-sm">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nom</label>
                    <input type="text" name="nom" 
                           value="{{ $produit->nom }}"
                           class="form-control form-control-sm" required>
                           <label class="form-label fw-semibold">Description</label>
                    <input type="text" name="description" 
                           value="{{ $produit->description }}"
                           class="form-control form-control-sm">
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Prix Achat</label>
                        <input type="number" name="prixappro" 
                               value="{{ $produit->prixappro }}"
                               class="form-control form-control-sm">
                    </div>

                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Prix Vente</label>
                        <input type="number" name="prix_vente" 
                               value="{{ $produit->prix_vente }}"
                               class="form-control form-control-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Stock</label>
                        <input type="number" name="qtestock" 
                               value="{{ $produit->qtestock }}"
                               class="form-control form-control-sm">
                               <div class="mb-3">
    <label class="form-label fw-semibold">Statut</label>
    <select name="statut" class="form-select form-select-sm" required>
        <option value="disponible" {{ $produit->statut == 'disponible' ? 'selected' : '' }}>
            Disponible
        </option>
        <option value="enrupture" {{ $produit->statut == 'enrupture' ? 'selected' : '' }}>
            En rupture
        </option>
    </select>
</div>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label fw-semibold">Catégorie</label>
                        <select name="categories_id" class="form-select form-select-sm" required>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}"
                                    {{ $produit->categories_id == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('vueproduit.index') }}" class="btn btn-secondary btn-sm">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-success btn-sm px-4">
                        Mettre à jour
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
