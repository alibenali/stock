@extends('layouts.app')

@section('content')
<div class="container">
<a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.achat') }}">Ajouter un achat</a>

    <table class="table table-responsive-sm" id="achat">
        <thead>
          <tr>
            <th>ID</th>
            <th>Produit</th>
            <th>Quantité acheté</th>
            <th>Prix d'achat</th>
            <th>statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($achats as $achat)
          <tr>
            <td>{{$achat->id}}</td>
          <td><a href="{{ url('produit/'.$achat->produit_id) }}">{{$achat->produit_id}}</a></td>
            <td>{{$achat->quantite}}</td>
            <td>{{$achat->prix_achat}}</td>
            <td>{{$achat->statut}}</td>
          </tr>
            @endforeach
        </tbody>
      </table>
</div>
<script type="application/javascript">
    $(document).ready(function() {
        $('#achat').DataTable();
    } );
    </script>
@endsection
