@extends('_layout.base')

@section('content')
<h1>{{ $artikel->judul_artikel }} </h1>
<h4>{!! $artikel->isi !!} </h4>

@if (App::getLocale()=='id')
@foreach ($artikel->dokumen as $dokumen)
<a href="{{ asset($dokumen->link_dokumen) }}" > {{ $dokumen->nama_dokumen }}</a>
<br>
@endforeach
@else 
@foreach ($artikel->document as $dokumen)
<a href="{{ asset($dokumen->link_dokumen) }}"> {{ $dokumen->nama_dokumen }}</a>
<br>
@endforeach
@endif
<br>
@if ($artikel->gambar)
<a href="{{ asset($artikel->gambar) }}"><img src="{{ asset($artikel->gambar) }}"></a> 
@endif


@stop