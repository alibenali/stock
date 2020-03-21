@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.casse', 0) }}">Ajouter une casse</a>

  <table class="table table-responsive-sm" id="vente">
      <thead>
        <tr>
          <th>ID</th>
          <th>Produit ID</th>
          <th>Utilisateur ID</th>
          <th>Quantite</th>
          <th>Observation</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($casses as $casse)
        <tr>
          <td>{{$casse->id}}</td>
        <td><a href="{{ url('produit/'.$casse->produit_id) }}" target="_blank">{{$casse->produit_id}}</a></td>
          <td>{{$casse->users->nom_complet}}</td>
          <td>{{$casse->quantite}}</td>
          <td>{{$casse->observation}}</td>
          <td>{{$casse->statut}}</td>

        <td>
            @can('annuler', $casse)
           <form method="POST" action='{{ route('annuler.casse', $casse->id) }}'>
            @csrf
            <button class="btn-danger">Annuler</button>
          </form>
            @endcan
          </td>
        </tr>
          @endforeach
      </tbody>
    </table>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#vente').DataTable();
} );
</script>
  @endsection