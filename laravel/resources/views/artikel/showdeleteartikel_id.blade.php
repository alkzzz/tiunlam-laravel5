@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Delete Artikel (ID)</div>
      <div class="panel-body">

        <h2>Apakah anda yakin akan menghapus artikel ini?</h2>
        <hr>
        <h3><a href="{{ route('tampil_artikel', [$artikel->kategori->slug_id, $artikel->slug]) }}">{{ $artikel->judul_artikel }}</a></h3>
        <hr>
        <div class="alert alert-danger">
          <h5>Gambar dan dokumen pada artikel ini juga akan dihapus.</h5>
        </div>
        <form action="{{ route('deleteartikel_id', $artikel->slug) }}" method="post">
      	<input type="hidden" name="_method" value="DELETE">
      	<input type="hidden" name="_token" value="{{ csrf_token() }}">
      	<button type="submit" class="btn btn-lg btn-danger">Ya</button>
        <a class="btn btn-lg btn-info" href="{{ route('admin-artikel_id') }}">Tidak</a>

	</div>
</div>
@stop