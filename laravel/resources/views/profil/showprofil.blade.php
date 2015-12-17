@extends('_layout.base')

@section('content')

<h1>{{ $profil->judul_profil }}</h1>
<article>{!! $profil->konten !!}</article>

@stop