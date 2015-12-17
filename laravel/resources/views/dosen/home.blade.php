@extends('_layout.admin')

@section('welcome')
<a class="navbar-brand" href="{{ url()}}">Welcome, {{ $dosen->nama }}</a>
@stop

@section('sidemenu')
<div class="navbar-inverse sidebar" role="navigation">
<div class="sidebar-nav navbar-collapse">
    <ul class="nav" id="side-menu">
        <li class="sidebar-search">
            <form method="post" action="{{ route('adminsearch') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" name="search" placeholder="Search...">
                <span class="input-group-btn">
                    <button id="search-btn" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                </form>
            </div>
            <!-- /input-group -->
        </li>
        <li>
            <a @unless (Request::is('dosen')) id ="dashboard-inactive" @endunless
            href="{{ route('dosen-home') }}"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
        </li>
        <li>
            <a href="menudosen1"><span class="glyphicon glyphicon-th-large"></span> Menu Dosen 1</a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="submenudosen1">Sub Menu Dosen 1</a>
                </li>
                <li>
                    <a href="submenudosen2">Sub Menu Dosen 2</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="menudosen2"><span class="glyphicon glyphicon-tasks"></span> Menu Dosen 2</a>
        </li>
        <li>
            <a href="menudosen3"><span class="glyphicon glyphicon-list-alt"></span> Menu Dosen 3</a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="submenudosen3">Sub Menu Dosen 3</a>
                </li>
                <li>
                    <a href="submenudosen4">Sub Menu Dosen 4</a>
                </li>
            </ul>
        </li>
        
    </ul>
</div>
<!-- /.sidebar-collapse -->
</div>
@stop

@section('content')
@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif

	<h1>Nama Dosen: {{ $dosen->nama }}</h1>
	<h2>NIP : {{ $dosen->NIP }}</h2>
@stop