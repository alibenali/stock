@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-12">
            <div class="card">
                <div class="card-header">Ajouter un pourcentage</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inserer.pourcentage') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="pour" class="col-md-4 col-form-label text-md-right">{{ __('Pour') }}</label>

                            <div class="col-md-6">
                                <input id="pour" type="text" class="form-control" name="pour" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="pourcentage" class="col-md-4 col-form-label text-md-right">{{ __('Le pourcentage') }}</label>

                            <div class="col-md-6">
                                <input id="pourcentage" type="text" class="form-control" name="pourcentage" required>
                            </div>
                        </div>  

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter le pourcentage') }}
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
