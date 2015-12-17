@extends('_layout.admin')

@section('content')

@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif
     <div class="panel panel-default">
        <div class="panel-heading">Ubah Password</div>
        <div class="panel-body">
            @include('errors.list')
            <form action="{{ route('updatepassword') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
            <label><h4>Masukkan Password Lama</h4></label>
            <input type="password" name="password_lama" class="form-control">
            </div>
            <div class="form-group">
            <label><h4>Masukkan Password Baru</h4></label>
            <input type="password" name="password" class="form-control">
            </div>
            <p>Apabila password dikosongkan maka akan tetap menggunakan password yang lama.</p>
            <div class="form-group">
            <label><h4>Konfirmasi Password Baru</h4></label>
            <input type="password" name="password_confirmation" class="form-control">
            </div>
            <br>
            <hr>
            <div class="form-group">
            <input type="submit" value="Save" class="btn btn-lg btn-success">
            </div>
        </div>
    </div>

@stop