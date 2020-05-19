@extends('layouts.app')

@section('content')
<div class="container">
  <table class="table table-responsive-sm">
      <thead>
        <tr>
          <th>Action</th>
          <th>Id produit</th>
          <th>Quantité vendu</th>
          <th>Prix total</th>
        </tr>
      </thead>
      <tbody>
          @PHP($total = 0)
          @foreach($ventes as $vente)
          @PHP($total = $total + $vente->prix_total)
        <tr>
          <td>
                @can('annuler', $vente)
                <form method="POST" action='{{ route('annuler_panier.vente', $vente->id) }}' class="d-inline">
                  @csrf
                  <button class="btn-danger btn-sm">Annuler</button></form>
                @endcan
          </td>
          <td><a href="{{ url('produit/'.$vente->produit_id) }}" target="_blank">{{$vente->produit_id}}</a></td>
          <td>{{$vente->quantite}}</td>
          <td>{{number_format($vente->prix_total, 0, '.', ' ')}}</td>

        
        </tr>
          @endforeach
      </tbody>
    </table>
    	@if($total != 0)
        <h3 class="text-center mx-auto d-block mt-2 mb-3">{{number_format($total, 0, '.', ' ')}}</h3>

        <form method="POST" action='{{ route('valider_tous.vente') }}'>
        @csrf
        <button class="btn-success text-center mx-auto d-block">Valider tous</button>
        </form>
        @else
        <h3 class="text-center mx-auto mt-2 mb-3">Panier vide</h3>
        @endif
</div>


  @endsection