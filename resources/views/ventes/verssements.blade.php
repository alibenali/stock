@extends('layouts.app')

@section('content')
<div class="container">
  <h5 class="text-center mb-5">Totale versé aujourd'hui: <b>{{number_format($totalVerssement, 0, '.', ' ')}}</b></h5>
  <table class="table table-responsive-sm" id="vente">
      <thead>
        <tr>
          <th>ID</th>
          <th>Bon ID</th>
          <th>Id produit</th>
          <th>Quantité vendu</th>
          <th>Nbr boites</th>
          <th>Prix unité</th>
          <th>Prix total</th>
          <th>Verssement</th>
          <th>Vendu le</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($ventes as $vente)
        <tr>
          <td>{{$vente->id}}</td>
          <td><a href="{{ url('ventes/panier/'.$vente->bon_id) }}" target="_blank">{{$vente->bon_id}}</a></td>
          <td><a href="{{ url('produit/'.$vente->produit_id) }}" target="_blank">{{$vente->produit_id}}</a></td>
          <td>{{$vente->quantite}}</td>
          <td>{{$vente->nbr_boites}}</td>
          <td>{{number_format($vente->prix_unite, 0, '.', ' ')}}</td>
          <td>{{number_format($vente->prix_total, 0, '.', ' ')}}</td>
          <td>{{number_format($vente->verssement, 0, '.', ' ')}}</td>
          <td>{{$vente->created_at}}</td>
          <td class="text-@if($vente->statut == 'pre facturation')success @endif">{{$vente->statut}}</td>

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
	  <h5 class="text-center mt-5">
		<a class="btn btn-dark" href="{{url('voire/verssements/')}}/1">Aujourd'hui</a>
		<a class="btn btn-info" href="{{url('voire/verssements/')}}/7">Une Semaine</a>
		<a class="btn btn-dark" href="{{url('voire/verssements/')}}/30">Un mois</a>
		<a class="btn btn-info" href="{{url('voire/verssements/')}}/90">3 mois</a>
		<a class="btn btn-dark" href="{{url('voire/verssements/')}}/365000">Tous</a>
	</h5>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#vente').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
  @endsection