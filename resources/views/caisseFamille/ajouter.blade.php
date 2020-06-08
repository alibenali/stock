@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('inserer.caisseFamille')}}">
                @csrf
              <div class="form-group">
                <label for="nomFamille">Nom de la famille</label>
                <input name="nom" type="text" class="form-control" id="nomFamille" placeholder="Ex: Maison">
              </div>
             
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>  
        </div>
    </div>   
</div>
@endsection
