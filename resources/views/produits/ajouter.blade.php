@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Creation de produit</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.produit') }}">
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
                            <label for="famille" class="col-md-4 col-form-label text-md-right">{{ __('Famille') }}</label>

                            <div class="col-md-6">
                                <select id="famille" class="form-control" name="famille" value="{{ old('famille') }}" required>
                                    @foreach($familles as $famille)
                                        <option value="{{$famille->id}}">{{$famille->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="designation" class="col-md-4 col-form-label text-md-right">{{ __('Designation') }}</label>

                            <div class="col-md-6">
                                <input id="designation" type="text" class="form-control" name="designation" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="colis" class="col-md-4 col-form-label text-md-right">{{ __('Colis dimensions') }}</label>

                            <div class="col-md-6">
                                <input oninput="calculateQuantite()" id="colis" type="number" step="0.01" lang="en" class="form-control" name="colis" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="nbr_colis" class="col-md-4 col-form-label text-md-right">{{ __('Nombre colis') }}</label>

                            <div class="col-md-6">
                                <input oninput="calculateQuantite()" id="nbr_colis" type="number" class="form-control" name="nbr_colis" required>
                            </div>
                        </div> 

                        <div class="form-group row">
                            <label for="quantite" class="col-md-4 col-form-label text-md-right">{{ __('Quantité') }}</label>

                            <div class="col-md-6">
                                <input id="quantite" type="number" step="0.01" class="form-control" name="quantite" required>
                            </div>
                        </div>    
                        
                        <div class="form-group row">
                            <label for="prix_achat" class="col-md-4 col-form-label text-md-right">{{ __('Prix d\'unité') }}</label>

                            <div class="col-md-6">
                                <input id="prix_achat" type="number" step="0.01" class="form-control" name="prix_achat" required>
                            </div>
                        </div>  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Creer le produit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function calculateQuantite(){
        var colis = $('#colis').val();
        var nbrColis = $('#nbr_colis').val();
        $('#quantite').val(colis*nbrColis);
    }
</script>
@endsection
