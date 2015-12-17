@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

<form action="{{ route('simpankategori') }}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="panel panel-default">
        <div class="panel-heading">Tambah Kategori Artikel</div>
           <div class="panel-body">
              @include('errors.list')
                <div class="form-group">
                <label><h4>Kategori (ID)</h4></label>
                <br>
                <input type="text" name="nama_id" class="form-control">
            	</div>
            	<hr>
                <div class="form-group">
                <label><h4>Kategori (EN)</h4></label>
                <br>
                <input type="text" name="nama_en" class="form-control">
                </div>
                <hr>
                <div class="form-group">
                <input type="submit" value="Save" class="btn btn-lg btn-success">
                </div>
        </div>
@stop