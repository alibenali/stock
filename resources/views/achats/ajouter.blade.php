@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Ajouter un achat</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.achat') }}">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="Fournisseur" class="col-md-4 col-form-label text-md-right">{{ __('Fournisseur') }}</label>

                            <div class="col-md-6">
                                <select id="Fournisseur" class="form-control" name="fournisseur" value="{{ old('fournisseur') }}" required>
                                    @foreach($fournisseurs as $fournisseur)
                                        <option value="{{$fournisseur->id}}">{{$fournisseur->nom_complet}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="produit" class="col-md-4 col-form-label text-md-right">{{ __('Produit ID') }}</label>

                            <div class="col-md-6">
                                <input id="produit" type="number" class="form-control" name="produit" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="quantite" class="col-md-4 col-form-label text-md-right">{{ __('La quantité') }}</label>

                            <div class="col-md-6">
                                <input id="quantite" type="text" class="form-control" name="quantite" required>
                            </div>
                        </div>  

                        <div class="form-group row">
                            <label for="prix_achat" class="col-md-4 col-form-label text-md-right">{{ __('Prix d\'achat') }}</label>

                            <div class="col-md-6">
                                <input id="prix_achat" type="text" class="form-control" name="prix_achat" required>
                            </div>
                        </div>  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter l\'achat') }}
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
