@extends('_layout.admin')

@section('content')

@if (count($hasil_admin))
<h2>Hasil Pencarian untuk "{{ $cari }}"</h2>
	@for ($i = 0; $i < count($hasil_admin); $i++)
		@if (array_key_exists('judul_profil', $hasil_admin[$i]))
			<br>
			 <a href="{{ url('id/profil') }}/{{ array_get($hasil_admin, $i.'.'.'slug') }}"><h4>{{ array_get($hasil_admin, $i.'.'.'judul_profil') }}</h4></a>
		@elseif (array_key_exists('judul_artikel', $hasil_admin[$i]))
			<br>
			 <a href="{{ url('id') }}/{{ array_get($hasil_admin, $i.'.'.'kategori'.'.'.'slug_id') }}/{{ array_get($hasil_admin, $i.'.'.'slug') }}"><h4>{{ array_get($hasil_admin, $i.'.'.'judul_artikel') }}</h4></a>
		@endif
	@endfor
@else
	<h2>Hasil pencarian untuk '{{ $cari }}' tidak ditemukan.</h2>
@endif
{!!  $paginate_admin->render() !!}


@stop