@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.transition') }}">Ajouter une transition</a>
  <h1 class="text-center mb-5 mt-5">Caisse: <b>{{$caisse}}</b> </h1>
  <table class="table table-responsive-sm" id="caisse">
      <thead>
        <tr>
          <th>ID</th>
          <th>Par</th>
          <th>Objectif</th>
          <th>Type</th>
          <th>Montant</th>
          <th>Caisse avant</th>
          <th>Caisse aprés</th>
        </tr>
      </thead>
      <tbody>
          @foreach($transitions as $transition)
        <tr>
          <td>{{$transition->id}}</td>
          <td>{{$transition->responsable_id}}</td>
          <td>{{$transition->objectif}}</td>
          <td>{{$transition->type}}</td>
          <td>{{$transition->montant}}</td>
          <td>{{$transition->caisse_avant}}</td>
          <td>{{$transition->caisse_apres}}</td>


        <td>
            @can('annuler')
           <form method="POST" action='{{ route('annuler.transition', $transition->id) }}'>
            @csrf
            <button class="btn-danger">Annuler</button>
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
    $('#caisse').DataTable();
} );
</script>
  @endsection