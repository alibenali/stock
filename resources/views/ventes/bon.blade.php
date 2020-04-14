@extends('layouts.app')

@section('content')

<style>
  @media print{@page {size: landscape}}
  tr td{
  padding: 0 !important;
  margin: 0 !important;
}
</style>

<div class="container" id="toPrint">
  <div class="row">
    <div class="col-6">
      <h1 style="font-size: 1.25rem;" class="mb-1 text-center"><b>Bienvenue chez Ayhem ceramique</b></h1>
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
        <p class="mt-1" style="font-size: 0.7rem;"><b>Remarque:</b> dès que le produit quitte le magasin, vous ne pouvez plus le retourner.</p>
    </div>
    <div class="col-6">
      <table class="table w-100" id="vente">
          <thead>
            <tr>
              <th>Produit</th>
              <th>Quantité vendu</th>
              <th>Prix total</th>
            </tr>
          </thead>
          <tbody>
            @PHP( $total = 0)
              @foreach($ventes as $vente)
              @PHP( $total = $total + $vente->prix_total )
            <tr>
              <td style="word-wrap: break-word">{{$vente->produit->designation}}</td>
              <td  style="width: 30%">{{$vente->quantite}}</td>
              <td  style="width: 30%;word-wrap: break-word">{{ceil(ceil($vente->prix_total)/10)*10}}</td>
            </tr>
              @endforeach
          </tbody>
        </table>
        <p class="mt-3 text-center"><b>Total:</b> {{ceil(ceil($total)/10)*10}}</p>
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