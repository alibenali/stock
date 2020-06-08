@extends('layouts.app')

@section('content')
<div class="container">
  <a class="btn btn-secondary btn-sm mb-5 w-25 mx-auto d-block " href="{{ route('ajouter.transition', ['id'=>0]) }}">Ajouter une transition</a>
  <h1 class="text-center mb-5" id="total"></h1>

  <table class="table table-responsive-sm" id="caisse">
      <thead>
        <tr>
          <th>ID</th>
          <th>Par</th>
          <th>Objectif</th>
          <th>Type</th>
          <th>Caisse avant</th>
          <th>Caisse aprés</th>
          <th>Montant</th>
        </tr>
      </thead>
      <tbody>
          @foreach($transitions as $transition)
        <tr>
          <td>{{$transition->id}}</td>
          <td>{{$transition->responsable_id}}</td>
          <td>{{$transition->objectif}}</td>
          <td>{{$transition->type}}</td>
          <td>{{$transition->caisse_avant}}</td>
          <td>{{$transition->caisse_apres}}</td>
          <td class="@if($transition->type == 'depense')bg-danger text-white @else bg-success @endif text-center">@if($transition->type == 'depense')-@endif{{$transition->montant}}</td>

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

jQuery.fn.dataTable.Api.register( 'sum()', function () {
    return this.flatten().reduce( function ( a, b ) {
        return (a*1) + (b*1); // cast values in-case they are strings
    });
});

$("#caisse").on('search.dt', function() { 
  var searchValue = $('.dataTables_filter input').val(); 
  if(searchValue != ''){
    $("#total").text(searchValue+': '+table.column( 4, {page:'current'} ).data().sum())
  }else{
    $("#total").text(' ')

  }
});

} );
</script>
  @endsection