@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Delete Profil (EN)</div>
      <div class="panel-body">

        <h2>Apakah anda yakin akan menghapus profil ini?</h2>
        <hr>
        <h3><a href="{{ route('showprofil_en', $profil->slug) }}">{{ $profil->judul_profil }}</a></h3>
        <hr>
        <form action="{{ route('deleteprofil_en', $profil->slug) }}" method="post">
      	<input type="hidden" name="_method" value="DELETE">
      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	<button type="submit" class="btn btn-lg btn-danger">Ya</button>
        <a class="btn btn-lg btn-info" href="{{ route('admin-profil_en') }}">Tidak</a>

	</div>
</div>
@stop