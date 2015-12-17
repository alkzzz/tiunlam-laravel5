@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Delete Profil (ID)</div>
      <div class="panel-body">

        <h2>Apakah anda yakin akan menghapus profil ini?</h2>
        <hr>
        <h3><a href="{{ route('admin-role') }}">{{ $role->display_name }}</a></h3>
        <hr>
        <form action="{{ route('deleteprofil_id', $role->name) }}" method="post">
      	<input type="hidden" name="_method" value="DELETE">
      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	<button type="submit" class="btn btn-lg btn-danger">Ya</button>
        <a class="btn btn-lg btn-info" href="{{ route('admin-role') }}">Tidak</a>

	</div>
</div>
@stop