@extends('layouts.app')

@section('content')
<div class="container">
  <table class="table table-responsive-sm" id="vente">
      <thead>
        <tr>
          <th>ID</th>
          <th>Id produit</th>
          <th>Quantité vendu</th>
          <th>Nbr boites</th>
          <th>Prix unité</th>
          <th>Prix total</th>
          <th>Vendu le</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($ventes as $vente)
        <tr>
          <td>{{$vente->id}}</td>
          <td><a href="{{ url('produit/'.$vente->produit_id) }}" target="_blank">{{$vente->produit_id}}</a></td>
          <td>{{$vente->quantite}}</td>
          <td>{{$vente->nbr_boites}}</td>
          <td>{{number_format($vente->prix_unite, 0, '.', ' ')}}</td>
          <td>{{number_format($vente->prix_total, 0, '.', ' ')}}</td>
          <td>{{$vente->created_at}}</td>
          <td>{{$vente->statut}}</td>

        <td>
          @can('annuler', $vente)
          <form method="POST" action='{{ route('annuler.vente', $vente->id) }}'>
            @csrf
            <button class="btn-danger">Annuler</button></form>
          @endcan
          </td>
        </tr>
          @endforeach
      </tbody>
    </table>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#vente').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
  @endsection