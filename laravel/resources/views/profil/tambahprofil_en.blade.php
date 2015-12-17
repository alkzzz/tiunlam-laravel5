@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

    <div class="panel panel-default">
    <div class="panel-heading">Tambah Profil (EN)</div>
      <div class="panel-body">
        @include('errors.list')
        <form action="{{ route('simpanprofil_en') }}" method="post">
        <div class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label> <h4>Judul Profil</h4> </label>
        <input type="text" name="judul_profil" class="form-control">
      </div>
      <div class="form-group">
        <label> <h4>Isi Profil</h4> </label>
        <textarea name="konten"> </textarea>
      </div>
      <button type="submit" style="margin-bottom: 20px" class="btn btn-lg btn-success">Save</button>
      </form>
    </div>
  </div>
   </div>

@stop