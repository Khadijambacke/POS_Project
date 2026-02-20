@extends('layouts.dashadmin')

@section('contenu')
<div class="container-fluid">

    <!-- Header de la page -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-tags me-2 text-primary"></i>Gestion des Catégories
        </h5>
        <a href="{{ route('storecategorie') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Nouvelle catégorie
        </a>
    </div>

    <!-- Message succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tableau des catégories -->
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
                            <td class="fw-semibold">{{ $categorie->statut}}</td>
                            <td>{{ $categorie->description ?? '—' }}</td>
                            <td>
                                <span class="badge {{ $categorie->statut === 'actif' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($categorie->statut) }}
                                </span>
                            </td>
                            <td>
                                <!-- Modifier -->
                                <a href="{{ route('editcategorie', $categorie->id) }}" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil"></i> Modifier
                                </a>

                                <!-- Supprimer -->
                                <form action="{{ route('deletecategorie', $categorie->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette catégorie ?')">
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

</div>
@endsection
