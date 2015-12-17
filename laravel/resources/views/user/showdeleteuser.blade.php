@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Delete User</div>
      <div class="panel-body">

        <h2>Apakah anda yakin akan menghapus user ini?</h2>
        <hr>
        <h3><a href="{{ route('admin-user') }}">{{ $user->username }}</a></h3>
        <hr>
        <form action="{{ route('deleteuser', $user->username) }}" method="post">
      	<input type="hidden" name="_method" value="DELETE">
      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	<button type="submit" class="btn btn-lg btn-danger">Ya</button>
        <a class="btn btn-lg btn-info" href="{{ route('admin-user') }}">Tidak</a>

	</div>
</div>
@stop