@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Ajouter une casse</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.casse', $produit_id) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="produit" class="col-md-4 col-form-label text-md-right">{{ __('Produit ID') }}</label>

                            <div class="col-md-6">
                                <input id="produit" type="text" class="form-control" name="produit" value="{{$produit_id}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantite" class="col-md-4 col-form-label text-md-right">{{ __('Quantite') }}</label>

                            <div class="col-md-6">
                                <input id="quantite" type="text" class="form-control" name="quantite" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="observation" class="col-md-4 col-form-label text-md-right">{{ __('Observation') }}</label>

                            <div class="col-md-6">
                                <input id="observation" type="text" class="form-control" name="observation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter la casse') }}
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
