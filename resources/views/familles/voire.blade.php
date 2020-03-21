@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.famille') }}">Ajouter une famille</a>

  <table class="table table-responsive-sm" id="vente">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Créer le</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($familles as $famille)
        <tr>
          <td>{{$famille->id}}</td>
          <td>{{$famille->nom}}</td>
          <td>{{$famille->created_at}}</td>
          <td>{{$famille->statut}}</td>

        <td>
            @can('desactiver', $famille)
           <form method="POST" action='{{ route('desactiver.famille', $famille->id) }}'>
            @csrf
            <button class="btn-danger">Désactiver</button>
          </form>
            @else
            <form method="POST" action='{{ route('activer.famille', $famille->id) }}'>
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