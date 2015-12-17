@extends('_layout.admin')

@section('content')
@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif

<h1>Halaman Dashboard</h1>

@stop