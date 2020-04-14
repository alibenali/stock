@extends('layouts.app')

@section('content')
<div class="container">
<a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.produit') }}">Ajouter un produit</a>

    <table class="table table-responsive-sm" id="produit">
        <thead>
          <tr>
            <th>ID</th>
            <th>Designation</th>
            <th>Quantité</th>
            <th>Colis dimensions</th>
            <th>Nombre colis</th>
            <th>Prix d'achat</th>

            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
          <tr>
          <td><a href="{{ url('produit/'.$produit->id) }}">{{$produit->id}}</a></td>
          <td>{{$produit->designation}}</td> 
          <td>{{$produit->quantite}}</td>
          <td>{{$produit->colis}}</td>
          <td>{{$produit->nbr_colis}}</td>
          <td>{{$produit->prix_achat}}</td>
          </tr>
            @endforeach
        </tbody>
      </table>
</div>
<script type="application/javascript">
    $(document).ready(function() {
        $('#produit').DataTable();
    } );
    </script>
@endsection
