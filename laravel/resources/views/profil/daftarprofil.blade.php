@extends('_layout.base')

@section('content')
<h1>Daftar Profil</h1>
<ul>
	@foreach( $daftarprofil as $profil)
	<li> <a href="{{ route('showprofil', $profil->slug) }}">{{ $profil->judul_profil }}</a></li>
	<li>{!! $profil->isi !!}
	<li>{{ $profil->created_at->format('l j F Y H:i:s') }}</li>
	@endforeach
</ul>
@stop