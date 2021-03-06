@extends('layouts.app')

@section('content')

<style>
  /*
  @media print{@page {size: landscape}}
  tr td{
  padding: 0 !important;
  margin: 0 !important;
}
  */
</style>

<div class="container-fluid" id="toPrint">
  <div class="row">
    <div class="@if(isset($prefacturation)) col-12 @else col-8 @endif">
      <h1 style="font-size: 1.25rem;" class="mb-1 text-center"><b>Bienvenue chez Ayham ceramique</b></h1>
      <h1 style="font-size: 0.8rem;" class="mb-1 text-center"><b>Page facebook: Ayham ceramique</b></h1>
      
      <h1 style="font-size: 0.8rem;" class="mb-1 text-center"><b>Le WhatsApp et le Viber est le numéro du magasin</b></h1>

      <table class="table w-100" id="vente">
          <thead>
            <tr>
              <th>Produit</th>
              <th>Quantité</th>
              <th>N.Boites</th>
              <th>P.unité</th>
              <th>P.total</th>
            </tr>
          </thead>
          <tbody>
            @PHP( $total = 0)
              @foreach($ventes as $vente)
              @PHP( $total = $total + $vente->prix_total )
            <tr>
              <td style="word-wrap: break-word">{{substr($vente->produit->designation,0,31)}}</td>
              <td  style="width: 15%">{{$vente->quantite}}</td>
              <td  style="width: 15%">{{$vente->nbr_boites}}</td>
              <td  style="width: 15%">{{number_format(ceil(ceil($vente->prix_unite)/10)*10,0,'.',' ')}}</td>
              <td  style="width: 20%;word-wrap: break-word">{{number_format(ceil(ceil($vente->prix_total)/10)*10,0,'.',' ')}}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
        <p class="mt-1 text-center"><b>Total:</b> {{number_format(ceil(ceil($total)/10)*10,0,'.',' ')}} da</p>
        @php
        if(isset($verssement)){
        echo '<h3 class="mt-1 text-center"><b>Total versé:</b> '.number_format(ceil(ceil($verssement)/10)*10,0,'.',' '). ' da</h3>';
        }

        @endphp
        <p class="mt-1 text-center">{{ \Carbon\Carbon::now('Africa/Algiers') }} <a class="ml-4">Bon N° {{ $bon }}</a> </p>
        <p class="mt-1" style="font-size: 0.8rem;"><b>Remarque:</b> Vérifier votre produit avant de quitter le magasin, Puiseque la maison n'accept plus le changement ou le rembourssement.</p>
        
    </div>
    <div class="col-4 border-left @if(isset($prefacturation)) d-none @endif">
      <table class="table w-100" id="vente">
          <thead>
            <tr>
              <th>Cat</th>
              <th>Pro</th>
              <th>Quan</th>
            </tr>
          </thead>
          <tbody>
            @PHP( $total = 0)
              @foreach($ventes as $vente)
              @PHP( $total = $total + $vente->prix_total )
            <tr>
              <td style="word-wrap: break-word">{{$vente->produit->familles->nom}}</td>
              <td style="word-wrap: break-word">{{$vente->produit->designation}}</td>
              <td  style="width: 30%">{{$vente->nbr_boites}}</td>

            </tr>
              @endforeach
          </tbody>
        </table>
    </div>
  </div>
</div>

<script type="application/javascript">
window.resizeTo(1024, 768);

function printDiv(divID) {
        //Get the HTML of div
        var divElements = document.getElementById(divID).innerHTML;
        //Get the HTML of whole page
        var oldPage = document.body.innerHTML;
        //Reset the page's HTML with div's HTML only
        document.body.innerHTML = 
          "<html><head><title></title></head><body>" + 
          divElements + "</body>";
        //Print Page
        window.print();
        //Restore orignal HTML
        document.body.innerHTML = oldPage;

    }

    printDiv('toPrint');

</script>

  @endsection