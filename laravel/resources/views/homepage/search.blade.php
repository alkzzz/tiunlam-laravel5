@extends('_layout.base')

@section('content')

@if(App::getLocale()=='id')

@if (count($hasil_id))
<h2>Hasil Pencarian untuk "{{ $cari }}"</h2>
	@for ($i = 0; $i < count($hasil_id); $i++)
		@if (array_key_exists('judul_profil', $hasil_id[$i]))
			<br>
			 <a href="{{ url('id/profil') }}/{{ array_get($hasil_id, $i.'.'.'slug') }}"><h4>{{ array_get($hasil_id, $i.'.'.'judul_profil') }}</h4></a>
		@elseif (array_key_exists('judul_artikel', $hasil_id[$i]))
			<br>
			 <a href="{{ url('id') }}/{{ array_get($hasil_id, $i.'.'.'kategori'.'.'.'slug_id') }}/{{ array_get($hasil_id, $i.'.'.'slug') }}"><h4>{{ array_get($hasil_id, $i.'.'.'judul_artikel') }}</h4></a>
		@endif
	@endfor
@else
	<h2>Hasil pencarian untuk '{{ $cari }}' tidak ditemukan.</h2>
@endif
{!!  $paginate_id->render() !!}
@else

@if (count($hasil_en))
<h2>Search results for "{{ $cari }}"</h2>
	@for ($i = 0; $i < count($hasil_en); $i++)
		@if (array_key_exists('judul_profil', $hasil_en[$i]))
			 <a href="{{ url('en/about') }}/{{ array_get($hasil_en, $i.'.'.'slug') }}"><h4>{{ array_get($hasil_en, $i.'.'.'judul_profil') }}</h4></a>
			 <br>
		@elseif (array_key_exists('judul_artikel', $hasil_en[$i]))
			 <a href="{{ url('en') }}/{{ array_get($hasil_en, $i.'.'.'kategori'.'.'.'slug_en') }}/{{ array_get($hasil_en, $i.'.'.'slug') }}"><h4>{{ array_get($hasil_en, $i.'.'.'judul_artikel') }}</h4></a>
			 <br>
		@endif
	@endfor
@else
	<h2>No results found for '{{ $cari }}'</h2>
@endif
{!!  $paginate_en->render() !!}
@endif

@stop