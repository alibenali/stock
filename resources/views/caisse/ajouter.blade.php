@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Ajouter une transition</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.transition') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="objectif" class="col-md-4 col-form-label text-md-right">{{ __('Objectif de la transition') }}</label>

                            <div class="col-md-6">
                                <input id="objectif" type="text" class="form-control" name="objectif" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type de la transition') }}</label>

                            <div class="col-md-6">
                                <select  id="type" class="form-control" name="type" required>
                                    <option value="depense">depense</option>
                                    <option value="revenue">revenue</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="montant" class="col-md-4 col-form-label text-md-right">{{ __('Le montant') }}</label>

                            <div class="col-md-6">
                                <input id="montant" type="text" class="form-control" name="montant" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter la transition') }}
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
