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
          @foreach($ventes as $vente)
        <tr>
          <td>
                @can('annuler', $vente)
                <form method="POST" action='{{ route('annuler.vente', $vente->id) }}' class="d-inline">
                  @csrf
                  <button class="btn-danger btn-sm">Annuler</button></form>
                @endcan
          </td>
          <td><a href="{{ url('produit/'.$vente->produit_id) }}" target="_blank">{{$vente->produit_id}}</a></td>
          <td>{{$vente->quantite}}</td>
          <td>{{$vente->prix_total}}</td>

        
        </tr>
          @endforeach
      </tbody>
    </table>

        <form method="POST" action='{{ route('valider_tous.vente') }}'>
        @csrf
        <button class="btn-success text-center mx-auto d-block">Valider tous</button>
        </form>
</div>


  @endsection