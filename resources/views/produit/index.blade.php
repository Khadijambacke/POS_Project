@extends('layouts.dashadmin')

@section('contenu')
<link rel="stylesheet" href="{{ asset('ressources/css/produits.css') }}">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Liste des Produits</h4>

        @if(Auth::check() && Auth::user()->role === 'admin')
        <button type="button"
            class="btn btn-dark"
            data-bs-toggle="modal"
            data-bs-target="#createProduitModal">
            Ajouter un produit
        </button>

        @endif
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row g-3">

        @if($produits->count() > 0)

        @foreach($produits as $produit)
        <div class="col-6 col-md-4 col-lg-2">

            <div class="amazon-card">
                <div class="amazon-img-wrapper">
                    @if($produit->image)
                    <img src="{{ asset('ressources/assets/'.$produit->image) }}"
                        class="amazon-img">
                    @else
                    <div class="amazon-img d-flex align-items-center justify-content-center bg-light">
                        <i class="bi bi-image text-muted"></i>
                    </div>
                    @endif
                    <span class="amazon-badge 
                            {{ $produit->statut == 'disponible' ? 'badge-success' : 'badge-danger' }}">
                        {{ $produit->statut }}
                    </span>
                </div>
                <div class="amazon-body">
                    <div class="amazon-title text-truncate">
                        {{ $produit->nom }}
                    </div>

                    <div class="amazon-price">
                        {{ number_format($produit->prix_vente, 0, ',', ' ') }} F
                    </div>
                </div>
                <div class="amazon-footer text-center mb-2">
                    <a href="{{ route('vueproduit.show', $produit->id) }}" class="btn btn-sm btn-warning w-75">
                        Voir plus
                    </a>
                </div>

            </div>

        </div>
        @endforeach

        @else
        <div class="col-12 text-center text-muted py-4">
            Aucun produit disponible
        </div>
        @endif

    </div>

</div>


<!-- Modal Ajouter Produit -->
<div class="modal fade" id="createProduitModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered"> <!-- Centré verticalement -->
    <div class="modal-content border-0 shadow">
      <form action="{{ route('vueproduit.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- En-tête du modal -->
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">
            <i class="bi bi-plus-circle"></i> Ajouter Produit
          </h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <!-- Corps du modal -->
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-semibold">Image</label>
            <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Nom</label>
            <input type="text" name="nom" class="form-control form-control-sm" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Code-barres</label>
            <input type="text" name="code_barre" class="form-control form-control-sm" placeholder="Saisir le code ou laisser vide pour génération automatique">
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold">Description</label>
            <input type="text" name="description" class="form-control form-control-sm">
          </div>

          <div class="row">
            <div class="col-6 mb-3">
              <label class="form-label fw-semibold">Prix Achat</label>
              <input type="number" name="prixappro" class="form-control form-control-sm">
            </div>
            <div class="col-6 mb-3">
              <label class="form-label fw-semibold">Prix Vente</label>
              <input type="number" name="prix_vente" class="form-control form-control-sm">
            </div>
          </div>

          <div class="row">
            <div class="col-6 mb-3">
              <label class="form-label fw-semibold">Stock</label>
              <input type="number" name="qtestock" class="form-control form-control-sm">
            </div>
            <div class="col-6 mb-3">
              <label class="form-label fw-semibold">Catégorie *</label>
              <select name="categories_id" class="form-select form-select-sm" required>
                <option value="">Choisir</option>
                @foreach($categories as $categorie)
                  <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>

        
        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-success btn-sm px-4">Enregistrer</button>
        </div>

      </form>
    </div>
  </div>
</div>







@endsection