@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.fournisseur') }}">Ajouter un fournisseur</a>

  <table class="table table-responsive-sm" id="fournisseur">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom complet</th>
          <th>Créer le</th>
        </tr>
      </thead>
      <tbody>
          @foreach($fournisseurs as $fournisseur)
        <tr>
          <td>{{$fournisseur->id}}</td>
          <td>{{$fournisseur->nom_complet}}</td>
          <td>{{$fournisseur->created_at}}</td>
        </tr>
          @endforeach
      </tbody>
    </table>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#fournisseur').DataTable();
} );
</script>
  @endsection