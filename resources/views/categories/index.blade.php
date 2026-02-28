@extends('layouts.dashadmin')

@section('contenu')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-tags me-2 text-primary"></i> Gestion des Catégories
        </h5>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategorieModal">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle catégorie
        </button>
    </div>
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-semibold">
            <i class="bi bi-list me-2"></i> Liste des catégories
        </div>

        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="5%">Nom</th>
                        <th width="25%">Description</th>
                        <th width="15%">Statut</th>
                        <th width="25%">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @if($categories->isEmpty())
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Aucune catégorie trouvée
                        </td>
                    </tr>
                    @else
                    @foreach($categories as $categorie)
                    <tr>
                        <td class="fw-semibold">
                            {{ $categorie->nom }}
                        </td>

                        <td>
                            {{ $categorie->description ?? 'Aucune description' }}
                        </td>

                        <td class="text-center">
                            @if($categorie->statut === 'actif')
                            <span class="badge bg-success">Actif</span>
                            @else
                            <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{ route('editecategorie', $categorie->id) }}"
                                class="btn btn-sm btn-outline-warning me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('deletecategorie', $categorie->id) }}"
                                method="POST"
                                
                                class="d-inline"
                                onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Création Catégorie -->
<div class="modal fade" id="createCategorieModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Créer une nouvelle catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('storecategorie') }}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-control">
                            <option value="actif">Actif</option>
                            <option value="inactif">Inactif</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection