@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-center mt-5">Caisse: <b>{{$caisse}}</b> </h1>
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.caisseFamille') }}">Ajouter une famille</a>
  <h1 class="text-center mb-5" id="total"></h1>

  <table class="table table-responsive-sm" id="caisse">
      <thead>
        <tr>
          <th></th>
          <th>Nom de la famille</th>
          <th>Totale</th>
          <th>Statut</th>
          <th>Creer le</th>
          <th>Dernier maj</th>
        </tr>
      </thead>
      <tbody>
          @foreach($familles as $famille)
        <tr>
          <td>
              <a class="btn btn-secondary" href="{{ route('ajouter.transition', ['id'=>$famille->id]) }}">Ajouter une transition</a>
              <a class="btn btn-secondary" href="{{ route('voire.transitions', ['famille'=>$famille->id]) }}">Voire plus</a>
          </td>
          <td><b>{{$famille->nom}}</b></td>
          <td>{{$famille->totale}}</td>
          <td>{{$famille->statut}}</td>
          <td>{{$famille->created_at}}</td>
          <td>{{$famille->updated_at}}</td>
        </tr>
          @endforeach
      </tbody>
    </table>
</div>

<script type="application/javascript">
$(document).ready(function() {
    var table = $('#caisse').DataTable( {
        "order": [[ 0, "desc" ]]
    } );

} );
</script>
  @endsection