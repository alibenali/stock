@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Modifier un utilisateur</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('maj.utilisateur', $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="nom_complet" class="col-md-4 col-form-label text-md-right">{{ __('Nom complet') }}</label>

                            <div class="col-md-6">
                            <input id="nom_complet" type="text" class="form-control" name="nom_complet" value="{{ $user->nom_complet }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nom_utilisateur" class="col-md-4 col-form-label text-md-right">{{ __('Nom utilisateur') }}</label>

                            <div class="col-md-6">
                                <input id="nom_utilisateur" type="text" class="form-control" name="nom_utilisateur" value="{{ $user->nom_utilisateur }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Le role') }}</label>

                            <div class="col-md-6">
                                <select id="role" name="role"  class="form-control" name="nom_utilisateur" required>
                                    <option value="{{ $user->role }}" selected>{{ $user->role }}</option>
                                    <option value="vendeur">Vendeur</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Appliquer les modifications') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
