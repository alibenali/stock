@extends('layouts.app')

@section('content')
<div class="container">

  <table class="table table-responsive-sm" id="users">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom complet</th>
          <th>Nom utilisateur</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->nom_complet}}</td>
          <td>{{$user->nom_utilisateur}}</td>
          <td>{{$user->role}}</td>
        <td>
        <a class="btn btn-primary btn-sm" href="{{ route('modifier.utilisateur', $user->id) }}">Modifier</a>
        </td>
        </tr>
          @endforeach
      </tbody>
    </table>
</div>

<script type="application/javascript">
$(document).ready(function() {
    $('#users').DataTable();
} );
</script>
  @endsection