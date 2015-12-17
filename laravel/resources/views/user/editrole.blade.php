@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit Role</div>
      <div class="panel-body">
        @include('errors.list')
        <form action="{{ route('updaterole', $role->name) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
        <label> <h4>Nama Role</h4> </label>
        <input type="hidden" name="name">
        <input type="text" name="display_name" class="form-control" value="{{ $role->display_name }}">
      </div>
      <div class="form-group">
        <label> <h4>Deskripsi Singkat</h4> </label>
        <input type="text" name="description" class="form-control" value="{{ $role->description }}">
      </div>
      <hr>
      <button type="submit" style="margin-bottom: 20px" class="btn btn-lg btn-success">Save</button>
      </form>
    </div>
  </div>
  </div>


@stop