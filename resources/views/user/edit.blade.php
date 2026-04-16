@extends('layouts.dashadmin')

@section('contenu')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-pencil-square me-2 text-primary"></i> Modifier l'utilisateur
        </h5>
        <a href="{{ route('personnels.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Retour à la liste
        </a>
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
            <i class="bi bi-person-lines-fill me-2"></i> Formulaire de modification
        </div>

        <div class="card-body">
            <form action="{{ route('personnels.update', $utilisateurs->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $utilisateurs->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $utilisateurs->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Rôle</label>
                    <select name="role" class="form-control" required>
                        <option value="admin" {{ $utilisateurs->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="caissier" {{ $utilisateurs->role === 'caissier' ? 'selected' : '' }}>Caissier</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="Laissez vide pour conserver l'ancien mot de passe">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('personnels.index') }}" class="btn btn-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
