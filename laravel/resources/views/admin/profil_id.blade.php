@extends('_layout.admin')

@section('content')

@if (Session::has('message'))
         <div class="alert alert-info">
            <h3>{{ Session::get('message') }}</h3>
         </div>   
@endif

    <div class="panel panel-default">
        <div class="panel-heading">Daftar Profil (ID)</div>
        <div class="panel-body">
            <div class="pull-left">
                <div class="btn-toolbar">
                    <a href="{{ route('tambahprofil_id') }}" class="btn btn-success">
                        <span class="glyphicon glyphicon-plus"></span>&nbsp;Tambah profil
                    </a>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($daftarprofil as $profil)
                        <tr>
                        <td style="vertical-align:middle"> <h4><a href="{{ route('showprofil_id', $profil->slug) }}">{{ $profil->judul_profil }}</a><h4></td>
                        <td style="vertical-align:middle"> <h4> {{ $profil->created_at->format('l j F Y H:i') }} </h4> </td>
                        <td style="vertical-align:middle"><a class="btn btn-warning" href="{{ route('editprofil_id', $profil->slug) }}">Edit</a></td>
                        <td style="vertical-align:middle"><a class="btn btn-danger" href="{{ route('showdeleteprofil_id', $profil->slug) }}">Delete</a></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="pull-left">
        {!! $daftarprofil->render() !!}
        </div>

@stop