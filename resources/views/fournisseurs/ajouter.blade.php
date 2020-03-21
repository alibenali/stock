@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Ajouter fournisseur</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.fournisseur') }}">
                        @csrf
    
                        <div class="form-group row">
                            <label for="nom_complet" class="col-md-4 col-form-label text-md-right">{{ __('Nom complet') }}</label>

                            <div class="col-md-6">
                                <input id="nom_complet" type="text" class="form-control" name="nom_complet" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="contacte" class="col-md-4 col-form-label text-md-right">{{ __('Contacte informations') }}</label>

                            <div class="col-md-6">
                                <input id="contacte" type="text" class="form-control" name="contacte" required>
                            </div>
                        </div>

                        
                                  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter le fournisseur') }}
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
