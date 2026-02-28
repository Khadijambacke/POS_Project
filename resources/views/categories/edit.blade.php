@extends('layouts.dashadmin')

@section('contenu')
<div class="container">

    <h4 class="mb-4">Modifier la catégorie</h4>

    <form action="{{ route('updatecategorie', $categorie->id) }}" method="POST">
        @csrf
       
        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control"
                   value="{{ old('nom', $categorie->nom) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $categorie->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-control" required>
                <option value="actif" {{ $categorie->statut == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="inactif" {{ $categorie->statut == 'inactif' ? 'selected' : '' }}>Inactif</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('toutcategrie') }}" class="btn btn-secondary">Retour</a>
        </div>

    </form>
</div>
@endsection
