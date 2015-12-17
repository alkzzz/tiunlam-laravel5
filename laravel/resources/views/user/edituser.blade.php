@extends('_layout.admin')

@section('css')
@parent
@include('includes.tinymce')
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Edit User</div>
      <div class="panel-body">
        @include('errors.list')
        <form action="{{ route('updateuser', $user->username) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
        <label> <h4>Role</h4> </label>
        <select name="role" class="form-control">
        <option value="{{ $role_user->name }}">{{ $role_user->display_name }}</option>
        @foreach ($roles as $role)
        <option value="{{ $role->name }}">{{ $role->display_name }}</option>
        @endforeach
        </select>
      </div>
        <div class="form-group">
        <label> <h4>Username</h4> </label>
        <input type="text" name="username" class="form-control" value="{{ $user->username }}">
      </div>
      <div class="form-group">
        <label> <h4>Email</h4> </label>
        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
      </div>
      <div class="form-group">
        <label> <h4>Password</h4> </label>
        <input type="password" name="password" class="form-control">
      </div>
            <div class="form-group">
        <label> <h4>Konfirmasi Password</h4> </label>
        <input type="password" name="password_confirmation" class="form-control">
      </div>
      <button type="submit" style="margin-bottom: 20px" class="btn btn-lg btn-success">Save</button>
      </form>
    </div>
  </div>
  </div>


@stop