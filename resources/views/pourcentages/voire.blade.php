@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.pourcentage') }}">Ajouter un pourcentage</a>

  <table class="table table-responsive-sm" id="vente">
      <thead>
        <tr>
          <th>ID</th>
          <th>Pour</th>
          <th>Pourcentage</th>
          <th>Créer le</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($pourcentages as $pourcentage)
        <tr>
          <td>{{$pourcentage->id}}</td>
          <td>{{$pourcentage->pour}}</td>
          <td>{{$pourcentage->pourcentage}}</td>
          <td>{{$pourcentage->created_at}}</td>
          <td>{{$pourcentage->statut}}</td>

        <td>
            @can('desactiver', $pourcentage)
           <form method="POST" action='{{ route('desactiver.pourcentage', $pourcentage->id) }}'>
            @csrf
            <button class="btn-danger">Désactiver</button>
          </form>
            @else
            <form method="POST" action='{{ route('activer.pourcentage', $pourcentage->id) }}'>
              @csrf
              <button class="btn-success">Activer</button>
            </form>
            @endcan
          </td>
        </tr>
          @endforeach
      </tbody>
    </table>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#vente').DataTable();
} );
</script>
  @endsection