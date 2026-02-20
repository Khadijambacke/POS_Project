@extends('layouts.dashadmin')

@section('contenu')

    <!-- Header page -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-tags me-2 text-primary"></i>Gestion des Catégories
        </h5>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjout">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle catégorie
        </button>
    </div>

    <!-- Message succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tableau categories -->
    <div class="card">
        <div class="card-header">
            <i class="bi bi-list me-2"></i>Liste des catégories
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                    <tr>
                        <td class="ps-3">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $categorie->nom }}</td>
                        <td>{{ $categorie->description ?? '—' }}</td>
                        <td>
                            @if($categorie->statut === 'actif')
                                <span class="badge bg-success">Actif</span>
                            @else
                                <span class="badge bg-secondary">Inactif</span>
                            @endif
                        </td>
                        <td>
                            <!-- Bouton modifier -->
                            <a href="{{ route('categories.edit', $categorie->id) }}"
                               class="btn btn-sm btn-outline-warning me-1">
                                <i class="bi bi-pencil"></i> Modifier
                            </a>

                            
                            <form action="{{ route('categories.delete', $categorie->id) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Supprimer cette catégorie ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>
                            Aucune catégorie trouvée
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modalAjout" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-plus-circle me-2 text-primary"></i>Nouvelle catégorie
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                            <input type="text" name="nom" class="form-control"
                                   placeholder="ex: Boissons" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3"
                                      placeholder="Description..."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Statut <span class="text-danger">*</span></label>
                            <select name="statut" class="form-select" required>
                                <option value="actif">Actif</option>
                                <option value="inactif">Inactif</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection