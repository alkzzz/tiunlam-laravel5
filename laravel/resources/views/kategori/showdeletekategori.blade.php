@extends('_layout.admin')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Delete Kategori</div>
      <div class="panel-body">

        <h2>Apakah anda yakin akan menghapus kategori ini?</h2>
        <hr>
        <h3><a href="">{{ $kategori->nama_id }}</a></h3>
        <hr>
        <div class="alert alert-danger">
          <h5>Kategori {{ $kategori->nama_en }} serta artikel yang termasuk pada kategori juga akan dihapus.</h5>
        </div>
        <form action="{{ route('deletekategori', $kategori->slug_id) }}" method="post">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-lg btn-danger">Ya</button>
        <a class="btn btn-lg btn-info" href="{{ route('admin-kategori') }}">Tidak</a>

  </div>
</div>
@stop