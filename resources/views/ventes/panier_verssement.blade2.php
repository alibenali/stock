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
          @PHP($verssement = 0)
          @foreach($ventes as $vente)
          @PHP($total = $total + $vente->prix_total)
          @PHP($verssement = $verssement + $vente->verssement)
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
        <h3 class="text-center mx-auto d-block mt-2 mb-3">Totale: {{number_format($total, 0, '.', ' ')}}</h3>
                @else
        <h3 class="text-center mx-auto mt-2 mb-3">Panier vide</h3>
        @endif

      @if($total_verse != 0 AND $total_verse < $total)

        <h3 class="text-center mx-auto d-block mt-2 mb-3">Totale Versé: {{number_format($total_verse, 0, '.', ' ')}}</h3>
        <div class="text-center mx-auto">
        @if(number_format($total, 0, '.', ' ') > number_format($verssement, 0, '.', ' '))
        <form method="POST" action='{{ route('ajouter_verssement.vente', ['bon_id' => $bon_id]) }}' class="d-inline" onsubmit="return verssement()">
        @csrf
        <input type="hidden" name="montant" id="montant">
        <button class="btn-seconder d-inline">Ajouter Verssement</button>
        </form>
    	  @endif
        @endif
      </div>

</div>

<script type="text/javascript">
  function verssement(){
  let montant = prompt('Montant du Verssement');
  if(montant <= {{$total - $total_verse}}){
    let confirmation = confirm('Vous voulez faire un verssement de '+ montant + 'da Vous ne pouvez plus annuler cela');
      if(montant > 0 && confirmation == true){
        document.getElementById('montant').value = montant;
        return true;
      }

  }else{
    alert('Veuillez insérer un montant inférieur ou égal au prix total');
    return false;
  }
  

  return false;

  }
</script>

  @endsection