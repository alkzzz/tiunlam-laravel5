@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit Profil (EN)</div>
      <div class="panel-body">
        @include('errors.list')
      <form action="{{ route('updateprofil_en', $profil->slug) }}" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="hidden" name="_method" value="patch">
      <div class="form-group">
        <label> <h4>Judul Profil</h4> </label>
        <input type="text" name="judul_profil" value="{{ $profil->judul_profil }}" class="form-control">
      </div>
      <div class="form-group">
        <label> <h4>Isi Profil</h4> </label>
        <textarea name="konten">{{ $profil->konten }} </textarea>
      </div>
      <button type="submit" style="margin-bottom: 20px" class="btn btn-lg btn-success">Save</button>
</div>
</div>
</form>

@stop