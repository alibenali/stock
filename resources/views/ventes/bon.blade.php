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
    <div class="col-8">
      <h1 style="font-size: 1.25rem;" class="mb-1 text-center"><b>Bienvenue chez Ayham ceramique</b></h1>
      <h1 style="font-size: 0.8rem;" class="mb-1 text-center"><b>Page facebook: Ayham ceramique</b></h1>
      
      <h1 style="font-size: 0.8rem;" class="mb-1 text-center"><b>Le WhatsApp et le Viber est le numéro du magasin</b></h1>

      <table class="table w-100" id="vente">
          <thead>
            <tr>
              <th>Produit</th>
              <th>Quantité</th>
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
              <td  style="width: 15%">{{ceil(ceil($vente->prix_unite)/10)*10}}</td>
              <td  style="width: 20%;word-wrap: break-word">{{ceil(ceil($vente->prix_total)/10)*10}}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
        <p class="mt-1 text-center"><b>Total:</b> {{ceil(ceil($total)/10)*10}}</p>
        <p class="mt-1 text-center">{{ \Carbon\Carbon::now('Africa/Algiers') }} <a class="ml-4">Bon N° {{ $vente->id }}</a> </p>
        <p class="mt-1" style="font-size: 0.7rem;"><b>Remarque:</b> Vérifier votre produit avant de quitter le magasin, Puiseque la maison n'accept plus le changement ou le rembourssement.</p>
        
    </div>
    <div class="col-4 border-left">
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
              <td  style="width: 30%">{{$vente->quantite}}</td>
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