@extends('_layout.base')

@section('content')
@if (App::getLocale()=='id')

<h1>Daftar {{ $kategori->nama_id }}</h1>

	@if (count($kategori->artikel))
		@foreach ($kategori->artikel as $artikel)
			<h3><a href="{{ route('tampil_artikel', [ $kategori->slug_id, $artikel->slug ]) }}">{{ $artikel->judul_artikel }}</a></h3>
			<h4>{!! $artikel->isi !!}</h4>
		@endforeach

	@else
		<h3>Tidak Ada {{ $kategori->nama_id }}</h1>
	@endif

@else

<h1>{{ $kategori->nama_en }} List</h1>
	
	@if (count($kategori->articles))
	@foreach ($kategori->articles as $article)
		<h3><a href="{{ route('tampil_artikel', [ $kategori->slug_en, $article->slug ]) }}">{{ $article->judul_artikel }}</a></h3>
		<h4>{!! $article->isi !!}</h4>
	@endforeach

	@else
		<h3>No {{ $kategori->nama_en }}</h1>
	@endif

@endif

@stop
